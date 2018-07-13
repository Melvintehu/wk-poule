<template>
    <div v-if="largeScreen">
        <slot>

        
        </slot>
    </div>
</template>

<script>
    export default {
        props: {

        },

        data() {
            return {
                largeScreen: false,
            }
        }, 

        mounted() {

            window.addEventListener('resize', this.handleResize)
            this.handleResize();
    
        },

        methods: {
            handleResize() {
                let screenWidth = Math.max(document.documentElement.clientWidth, window.innerWidth || 0);
                    console.log('outside', screenWidth);    
                if(screenWidth > 767){//get the screen width
                    //get element form document
                    this.largeScreen = true;
                    console.log('test');
                } else {
                    this.largeScreen = false;
                }

                console.log(this.largeScreen)
            }
        }
    }    
</script>