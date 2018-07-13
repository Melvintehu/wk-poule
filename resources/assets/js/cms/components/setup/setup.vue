<template>
    <div>

        <!-- Render photo input  -->
        <crud-photo v-if="loaded" :identifier="identifier" :type="type" :attribute="attribute"> </crud-photo>

    </div>
</template>

<script>
    export default {
        props: {
            
        },

        data() {
            return {
                attribute: null,
                type: null,
                identifier: null,
                loaded: false,
            }
        }, 
 
        mounted() {
            this.attribute = {
                type: 'photo',
                translation: 'Kies een foto',
                dimensions: {"1x1": 'portrait'},
            };

            this.type = 'User';
            this.identifier = 'user';

            Event.listen('file:ready', () => {
                Factory.getStaticInstance('user').find(window.user_id).then((user) => {
                    Event.fire(this.type.toLowerCase() + ":added", user);
                });
            });

            setTimeout(() => {
                this.loaded = true;
            }, 10);
        },

        methods: {
            
        }
    }    
</script>