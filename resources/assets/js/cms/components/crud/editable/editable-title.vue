<template>
<div @dblclick="openOverlay()" :id="'title'+ this.id" :class=" isAuthorized ? 'pointer' : ''">

    
    <!-- Content of the title -->
    <slot></slot>

    <!-- the overlay -->
    <overlay v-if="isAuthorized"  :identifier="id + 'title'">
        <input style="border-color: #f1f1f1;" class="border full-width space-inside-sides-md space-inside-md space-outside-down-xs" v-model="title"  />


        <button @click="update" style="background: #E65100;" class="text-light border-none margin-sides-md margin-md"> aanpassen </button>
    </overlay>
</div>

</template>

<script>
  

    export default {
        props: {
            id: null,
        },

        data() {
            return {
                section: null,
                titles: null,
                title: null,
                isAuthorized: false,
            }
        },

        mounted() {
            this.load();
            Event.listen('editable:updates', () => {
                this.load();
            });

            this.authorized();
            
        },

        methods: {
            load() {
                Factory.getStaticInstance('section').find(this.id).then((section) => {
                    this.section = section;
                    this.setUpReference();
                    this.populateHtml(section.title);
                    this.populateInput();
                });
            },

            authorized() {
                User.isA(['admin']).then((authorized) => {
                    this.isAuthorized = authorized;
                });
            },
            
            openOverlay() {
                    
                Event.fire('overlay:open' + this.id + 'title');
            },

            setUpReference() {
               this.titles = $('#title' + this.id).find('span.__text_content__');                
            },

            populateHtml(title) {
                let amountOfParts = this.titles.length;
                let titleInParts = title.split(" ");
                
                for(let i = 1; i <= amountOfParts; i++) {
                    if(i < amountOfParts ) {
                        
                        this.titles[i-1].innerHTML = titleInParts.shift();
                    } else {
                        this.titles[i-1].innerHTML = titleInParts.join(" ");
                    }
                  
                }
            },

            populateInput() {
                this.title = _.map(this.titles, (title) => {
                    return title.innerHTML;
                }).join(' ');

                
            },

            update() {
                this.populateHtml(this.title);

                this.section.title = this.title;
                this.section.update().then(() => {
                    Event.fire('editable:updates');
                    Event.fire('overlay:close');
                    
                });
            }
        }


    }
</script>