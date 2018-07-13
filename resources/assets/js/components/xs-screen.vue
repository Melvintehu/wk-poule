<template>
    <div v-if="smallScreen">
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
                smallScreen: false,
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
                if(screenWidth <= 767){//get the screen width
                    //get element form document
                    this.smallScreen = true;
                    console.log('test');
                } else {
                    this.smallScreen = false;
                }

                console.log(this.smallScreen)
            }
        }
    }    
</script>