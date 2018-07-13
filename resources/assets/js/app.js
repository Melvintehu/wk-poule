    /*
    |--------------------------------------------------------------------------
    | Imports
    |--------------------------------------------------------------------------
    |
    | Import external libraries here
    | 
    | 
    |
    */
    
    import toaster from 'toastr/build/toastr.min';
    import moment from 'moment';

    /*
    |--------------------------------------------------------------------------
    | Require modules
    |--------------------------------------------------------------------------
    |
    | Require external libraries here
    | 
    | 
    |
    */
        
    let bootstrap = require('./bootstrap');
    let owlCarousel = require('owl-carousel-2/owl.carousel');
    let toastr = require('toastr/build/toastr.min');
    let vue = require('vue');
    let wow = require('wowjs/dist/wow.min').WOW;
    let sweetAlert =  require('sweetalert/dist/sweetalert.min');

    


     /*
    |--------------------------------------------------------------------------
    | Window
    |--------------------------------------------------------------------------
    |
    | Bind libraries to the window below here
    | 
    | 
    |
    */
        
    window.SweetAlert = sweetAlert;
    window.WOW = wow;
    window.Vue = vue;
    window.toastr = toaster;
    window.moment = require('moment');


    /*
    |--------------------------------------------------------------------------
    | Settings and init
    |--------------------------------------------------------------------------
    |
    */
	
    moment.locale('nl');

    $(document).ready(function() {
        new WOW().init();
    });


    /*
    |--------------------------------------------------------------------------
    | CMS and Vue entrypoint
    |--------------------------------------------------------------------------
    |
    | 
    | 
    | 
    |
    */
	
    require('./cms/app.js');

    /*
    |--------------------------------------------------------------------------
    | Custom project components
    |--------------------------------------------------------------------------
    |
    | Put all of your custom components in here.
    | 
    | 
    |
    */

    Vue.component('breadcrumb', require('./components/breadcumb.vue'));
    Vue.component('text-to-speech', require('./components/text-to-speech.vue'));
    Vue.component('competence', require('./components/competence.vue'));
 
        /*
    |--------------------------------------------------------------------------
    | Vue entrypoint
    |--------------------------------------------------------------------------
    |
    | 
    | 
    | 
    |
    */

    Vue.component('xs-screen', require('./components/xs-screen.vue'));
    Vue.component('lg-screen', require('./components/lg-screen.vue'));

    Vue.component('section-display', require('./cms/components/crud/editable/section.vue'));
    Vue.component('wedstrijd-overzicht', require('./components/wedstrijd-overzicht.vue'));

    const app = new Vue({
        el: '#app',
    });


    $(document).ready(function() {
     
        $(window).resize(function(){
            
            // If there are multiple elements with the same class, "main"
            $('.__square__').each(function() {
                $(this).height($(this).width());
                console.log('werkt niet');
            });
    
            // $(function() {
            //     $('.icon').css({
            //         'position' : 'absolute',
            //         'left' : '50%',
            //         'top' : '50%',
            //         'margin-left' : -$('.icon').outerWidth()/2,
            //         'margin-top' : -$('.icon').outerHeight()/2
            //     });
            // });
    
    
        }).resize();
    
    
    
    });

    

    $('.overlay-slidedown-activator').stop().on('mouseenter', function() {
        
        $(this).find('.overlay-slidedown').stop().slideDown(420);
    });

    $('.overlay-slidedown').stop().on('mouseleave', function() {
        $(this).stop().slideUp(420);
    });

    