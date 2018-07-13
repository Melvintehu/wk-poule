<template>
    <div v-html="section.body">
    
    </div>
</template>

<script>
  

    export default {
        props: {
            id: null,
        },

        data() {
            return {
                section: null
            }
        },

        mounted() {
            
            this.load();
        },

        methods: {
            load() {
                Factory.getStaticInstance('section').find(this.id).then((section) => {
                    this.section = section;
                });

            }
        }
    }
</script>