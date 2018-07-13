<template>
     <!-- Menu -->
    <div class="col-lg-12">
        <div class="row space-inside-down-md">

            <newsletter-menu-item @click.native="selectComponent('send-newsletter')" icon="mail" name="Verstuur nieuwsbrief"></newsletter-menu-item>
            <newsletter-menu-item @click.native="selectComponent('view-newsletter')" icon="remove_red_eye" name="Bekijk oude nieuwsbrieven"></newsletter-menu-item>
            <newsletter-menu-item @click.native="selectComponent('newsletter-settings')" icon="settings" name="Instellingen"></newsletter-menu-item>

            <keep-alive>
                <transition name="fade" :duration="{ enter: 800, leave: 0 }">
                    <component v-if="selectedComponent != null" :is="selectedComponent"></component>
                </transition>
            </keep-alive>
            
        </div>
    </div>
</template>
<style>
    
    .square {
        position: relative;
    }

    .folder-name {
        position: absolute;
        bottom: 0px;
        left: 0px;
        
    }

    .operationButton {
        line-height: 10px;
    }

    .operationButton:hover > i{
        color: white !important;
    }

    .square:hover > .folder-name {
        background: #354052;
        color: white;
    }

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

       },

       data() {
           return {
               selectedComponent: null,
           }
       },

       mounted() {
            $(document).ready(function() {
                $(window).resize(function(){
                    // If there are multiple elements with the same class, "main"
                    $('.square').each(function() {
                        $(this).height($(this).width());
                    });

                    $(function() {
                        $('.icon').css({
                            'position' : 'absolute',
                            'left' : '50%',
                            'top' : '50%',
                            'margin-left' : -$('.icon').outerWidth()/2,
                            'margin-top' : -$('.icon').outerHeight()/2
                        });
                    });


                }).resize();



            });
       },

       methods: {
          selectComponent(component_name) {
              this.selectedComponent = component_name;
          }
       }
   }   
</script>

