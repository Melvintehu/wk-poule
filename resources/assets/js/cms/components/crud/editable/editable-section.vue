<template>
    
<div @dblclick="openOverlay()" :id="'body'+ this.id" :class=" isAuthorized ? 'pointer' : ''">
    <slot></slot>
    <overlay  v-if="isAuthorized" :identifier="id + 'section'">
    
        <quill-editor v-model="body" :options="quillOptions" class="padding-up-md margin-sides-sm" > </quill-editor>

        <button @click="update" class="bg-main text-light border-none margin-sm uppercase padding-sm padding-sides-sm margin-sides-sm"> aanpassen </button>
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
                contents: null,
                body: null,
                isAuthorized: false,
                quillOptions: {
                   modules: {
                       toolbar: [
                            ['bold', 'italic'],
                            [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                            ['link', 'image']
                        ]
                   }
               }
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
                    this.populateHtml(section.body);
                    this.populateInput();
                });

            },

            authorized() {
                User.isA(['admin']).then(() => {
                    this.isAuthorized = true;
                });
            },

            openOverlay() {
                Event.fire('overlay:open' + this.id + 'section');
            },

            setUpReference() {
               this.contents = $('#body' + this.id + ' span.__text_content__');      
              
      
            },

            populateHtml(body) {
                let amountOfParts = this.contents.length;
                let bodyInParts = body.split(" ");
                
                for(let i = 1; i <= amountOfParts; i++) {
                    if(i < amountOfParts ) {
                        
                        this.contents[i-1].innerHTML = Helper.nl2br(bodyInParts.shift(), false);
                    } else {
                        this.contents[i-1].innerHTML = Helper.nl2br(bodyInParts.join(" "), false);
                    }
                  
                }
            },

            populateInput() {
                this.body = _.map(this.contents, (body) => {
                    return body.innerHTML.replace(/<br\s*[\/]?>/gi, "");
                }).join(' ');
                this.body = this.body.replace(/<br\s*[\/]?>/gi, "");

                
            },

            update() {
                this.populateHtml(this.body);

                this.section.body = this.body;
                this.section.update().then(() => {
                    Event.fire('editable:updates');
                    Event.fire('overlay:close');
                });
            }
        }


    }
</script>