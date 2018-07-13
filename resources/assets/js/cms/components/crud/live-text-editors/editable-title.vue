<template>
    
<div :id="'title'+ this.id">
    <slot></slot>
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
                title: null,
            }
        },

        mounted() {
            Factory.getStaticInstance('section').find(this.id).then((section) => {
                this.section = section;
                Event.fire('editable-title:prepare', section);
            });


            Event.listen('editable-title:prepare', (section) => {
                this.setUpReference();
            });
        },

        methods: {
            setUpReference() {
               this.title = $('#title' + this.id).children().html();
              
                
            }
        }


    }
</script>