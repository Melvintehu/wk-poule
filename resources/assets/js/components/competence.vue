<template>
    <div>
        <div class="col-lg-1">
            <i class="material-icons text-color-light space-inside-left-md xs-space-inside-left-lg-none font-lg"><slot name="icon"></slot></i>
        </div>
        <div class="col-lg-5">
            <h3 class="text-color-light"><slot name="title"></slot></h3>

            <p class="text-color-light space-inside-sm line-height-xs xs-space-inside-down-lg"> <slot name="description"></slot></p>
        </div>
    </div>
</template>

<script>
    export default {
        props: {

        },

        data() {
            return {

            }
        }, 

        mounted() {

        },

        methods: {
            
        }
    }    
</script>