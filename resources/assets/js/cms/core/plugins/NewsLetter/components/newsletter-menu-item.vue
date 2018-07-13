<template>
    <div  class="col-lg-2 col-md-2 col-sm-4 col-xs-6 space-outside-down-md">
        <div class="bg-secondary transition-normal bg-secondary-hover-darken-xs square shadow-xs  pointer text-center">
            <i class="icon inline-block material-icons text-color-accent " style='font-size: 50px;'>{{ icon }}</i>
            <span class="folder-name block full-width space-inside-sm">{{ name }}</span>
        </div>
    </div>
</template>
<script>
   export default {
       props: {
           name: "",
           icon: ""
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

