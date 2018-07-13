<template>
    <div>
        <div @dblclick="openOverlay()">

            <!-- this is where the image will be displayed -->
            <slot>
            
            </slot>
        </div>

        <!-- the overlay -->
        <overlay v-if="isAuthorized()"  :identifier="id + 'title'">

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

            }
        }, 

        mounted() {

        },

        methods: {
            openOverlay() {
                
            }
        }
    }    
</script>