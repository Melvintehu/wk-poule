<template>
    
<div :id="this.id">
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
             
            }
        },

        mounted() {
           
        }
    }
</script>