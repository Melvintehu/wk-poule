<template>
   <div class="inline-block pointer" @click="speak()" >
        <i class="material-icons text-color-main">mic</i>
        <slot></slot>
   </div>
</template>

<script>
    let speechSynthesis = require('speech-synthesis');
   export default {
       props: {
           text: null,
       },

       data() {
           return {

           }
       },

       mounted() {

       },

       methods: {
          speak() {
              speechSynthesis(this.text, 'nl-NL')
          }
       }
   }   
</script>

