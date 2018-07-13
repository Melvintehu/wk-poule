<template>
   <div class="inline-block">
        <div v-if="state === undefined" class="space-inside-left-sm">
            <div @click="setAvailability('active')" class="space-outside-sm pointer">
                <div class="bg-success circle 
                shadow-xs space-outside-sides-xs 
                border border-light pointer
                inline-block" style="width: 15px; height: 15px; position: relative; top: 5px;">
                </div>

                <p class="inline-block" :class="{'text-bold': currentState === 'active'}">Beschikbaar</p>
            </div>
            
            <div @click="setAvailability('away')" class="pointer">
                <div class="bg-warning circle 
                shadow-xs space-outside-sides-xs 
                border border-light
                inline-block" style="width: 15px; height: 15px; position: relative; top: 5px;">
                </div>

                <p class="inline-block" :class="{'text-bold': currentState === 'away'}">Niet aanwezig</p>
            </div>
            
            <div @click="setAvailability('inactive')" class="space-outside-sm pointer">
                <div class="bg-error circle 
                shadow-xs space-outside-sides-xs 
                border border-light pointer
                inline-block" style="width: 15px; height: 15px; position: relative; top: 5px;">
                </div>

                <p class="inline-block" :class="{'text-bold': currentState === 'inactive'}">Bezet</p>
            </div>
        </div>
        <div class="inline-block" v-else>
            <transition name="fade">
                <div v-if="currentState === 'active'">
                    <div class="bg-success circle 
                    shadow-xs space-outside-sides-xs 
                    border border-light pointer
                    inline-block" style="width: 15px; height: 15px; position: relative; top: 5px;">
                    </div>
                </div>
                <div v-if="currentState === 'away'">
                    <div class="bg-warning circle 
                    shadow-xs space-outside-sides-xs 
                    border border-light pointer
                    inline-block" style="width: 15px; height: 15px; position: relative; top: 5px;">
                    </div>
                </div>
                <div v-if="currentState === 'inactive'">
                    <div class="bg-error circle 
                    shadow-xs space-outside-sides-xs 
                    border border-light pointer
                    inline-block" style="width: 15px; height: 15px; position: relative; top: 5px;">
                    </div>
                </div>
            </transition>
        </div>
   </div>
</template>
<style type="text/css">
    .fade-enter-active, .fade-leave-active {
      transition: opacity .5s
    }
    .fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
      opacity: 0
    }
</style>
<script>
   export default {
       props: {
           state: null,
       },

       data() {
           return {
               currentState: null,
           }
       },

       mounted() {
           if(localStorage.getItem('userAvailability') === null){
               localStorage.setItem('userAvailability', 'active');
               Event.fire('availability:newState', 'active');
           }else{
               this.currentState = localStorage.getItem('userAvailability');
           }

           Event.listen('availability:newState', (state) => {
                 this.currentState = state;    
             });
       },

       methods: {
          setAvailability(state) {
              localStorage.setItem('userAvailability', state);
              Event.fire('availability:newState', state);
          }
       }
   }   
</script>

