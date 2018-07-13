
    /*
    |--------------------------------------------------------------------------
    | Modules CMS
    |--------------------------------------------------------------------------
    |
    | These files are used to load the different modules of the CMS.
    |
    | 
    |
    */

    // require('material-design-icons');
    require('./core/helpers/Classes');
    require('./core/imports');

    // custom models for cms
    require('./Objects');
    
    require('./core/models/objects');
    require('./core/plugins/index');

    import VueQuillEditor from 'vue-quill-editor';

    // require styles
    import 'quill/dist/quill.core.css';
    import 'quill/dist/quill.snow.css';
    import 'quill/dist/quill.bubble.css';
    Vue.use(VueQuillEditor);
    

    window.collect = require('collect.js');
    collect().macro('whereContains', function(attribute, value) {
        return this.filter((item) => {
            return collect(item[attribute]).contains(value);
        })
    });

    collect().macro('whereNotContains', function(attribute, value) {
        return this.filter((item) => {
            return !collect(item[attribute]).contains(value);
        })
    });
    
    Vue.component('context-menu', require('vue-context-menu'));

    // dashboard
    Vue.component('dashboard-search',  require('./components/dashboard/DashboardSearch.vue'));
    
    // progress
    Vue.component('progressbar', require('./components/crud/progress/progressbar.vue'));
    
    // Plugin entrypoint
    Vue.component('plugin', require('./components/plugin/plugin.vue'));


    /*
    |--------------------------------------------------------------------------
    | Forgot password components
    |--------------------------------------------------------------------------
    |
    | Components that are used for the forgot password functionality.
    | 
    |
    */
    Vue.component('forgot-password', require('./components/password-forget/forgot-password.vue'));
    
    /*
    |--------------------------------------------------------------------------
    | Read components
    |--------------------------------------------------------------------------
    |
    | Components that give extra functionality to the read.vue component
    | 
    | 
    |
    */

    Vue.component('sortable', require('./components/crud/read/sortable.vue'));
    Vue.component('paginator', require('./components/crud/read/paginator.vue'));

    /*
    |--------------------------------------------------------------------------
    | Navigation components
    |--------------------------------------------------------------------------
    |
    | Components that compose the navigation. They support the navigation with
    | Vue fuctionality
    | 
    |
    */


    Vue.component('nav-link', require('./components/nav/nav-link.vue'));
    Vue.component('nav-search', require('./components/nav/nav-search.vue'));
    Vue.component('nav-user-active', require('./components/nav/nav-user-active.vue'));
    Vue.component('pull-menu-cms', require('./components/menu/pull-menu-cms.vue'));
    Vue.component('plugin-nav', require('./components/nav/plugin-nav.vue'));
    Vue.component('overlay', require('./components/overlay/overlay.vue'));
    
       

    /*
    |--------------------------------------------------------------------------
    | Core crud components
    |--------------------------------------------------------------------------
    |
    | Components that are vital to the CMS. They are the core of the generated
    | crud functionality. 
    | 
    |
    */

    Vue.component('add', require('./components/crud/Add.vue'));
    Vue.component('read', require('./components/crud/Read.vue'));
    Vue.component('input-renderer', require('./components/InputRenderer.vue'));
    Vue.component('input-renderer-update', require('./components/crud/InputRendererUpdate.vue'));
    Vue.component('attribute-title', require('./components/crud/attribute/attribute-title.vue'));
    Vue.component('loading', require('./components/loading/loading.vue'));

    /*
    |--------------------------------------------------------------------------
    | Custom inputs
    |--------------------------------------------------------------------------
    |
    | The custom inputs are used to provide certain functionality out of the
    | box. The prefix 'crud' is required in order to avoid naming collisions
    | with other components that might exists in future projects.
    |
    */

    Vue.component('crud-boolean', require('./components/crud/inputTypes/boolean.vue'));
    Vue.component('crud-date', require('./components/crud/inputTypes/date.vue'));
    Vue.component('crud-model', require('./components/crud/inputTypes/model.vue'));
    Vue.component('crud-model-checkbox', require('./components/crud/inputTypes/model_checkbox.vue'));
    Vue.component('crud-number', require('./components/crud/inputTypes/number.vue'));
    Vue.component('crud-photo', require('./components/crud/inputTypes/photo.vue'));
    Vue.component('crud-select', require('./components/crud/inputTypes/select.vue'));
    Vue.component('crud-time', require('./components/crud/inputTypes/time.vue'));
    Vue.component('crud-textarea', require('./components/crud/inputTypes/textarea.vue'));
    Vue.component('crud-text', require('./components/crud/inputTypes/text.vue'));
    Vue.component('crud-website', require('./components/crud/inputTypes/website.vue'));
    Vue.component('crud-youtube', require('./components/crud/inputTypes/youtube.vue'));
    Vue.component('crud-multi_photo', require('./components/crud/inputTypes/multi_photo.vue'));
    Vue.component('crud-icon', require('./components/crud/inputTypes/icon.vue'));
    Vue.component('crud-password', require('./components/crud/inputTypes/password.vue'));
    
    /*
    |--------------------------------------------------------------------------
    | Live page edit components
    |--------------------------------------------------------------------------
    |
    | These components are used on the website, to provide the user with an 
    | easy way to edit certain elements on a webpage. Currently you can 
    | only edit sections of webpages that contain text. 
    |
    */
    
    Vue.component('editable-section', require('./components/crud/editable/editable-section.vue'));
    Vue.component('editable-title', require('./components/crud/editable/editable-title.vue'));
    Vue.component('editable-text', require('./components/crud/editable/text.vue'));
    Vue.component('editable-photo', require('./components/crud/editable/editable-photo.vue'));

    /*
    |--------------------------------------------------------------------------
    | Photo components
    |--------------------------------------------------------------------------
    |
    | Because photos are much more complex then editing text or basic crud, we
    | use custom components that are specifically made for managing photos. 
    | They are automatically loaded when used in your javascript models.
    |
    */

    Vue.component('image-uploader', require('./components/ImageUploader.vue'));
    Vue.component('cropper', require('./components/Cropper.vue'));
    Vue.component('multi-image-uploader', require('./components/multiImageUploader.vue'));


    /*
    |--------------------------------------------------------------------------
    | Validation
    |--------------------------------------------------------------------------
    |
    | Validation is made easy with the components below. These are used to 
    | display any error messages the are fired from a custom input.
    | 
    |
    */


    Vue.component('validation-display', require('./components/validation/validation_display.vue'));


    /*
    |--------------------------------------------------------------------------
    | Tutorials
    |--------------------------------------------------------------------------
    |
    | The CMS is focused on providing the best user expierence possible.
    | That's why we have some tutorial components. These components guide
    | the user and provide the user with feedback in the cms when need.
    |
    */

    Vue.component('tooltip', require('./components/tutorials/tooltip.vue'));

    
    /*
    |--------------------------------------------------------------------------
    | Setup
    |--------------------------------------------------------------------------
    | 
    | When the CMS is first loaded, the CMS guides the user through some 
    | settings that need to be configured before the CMS is fully operational.
    | These components provide that functionality.
    |
    |
    */

    Vue.component('setup', require('./components/setup/setup.vue'));
    Vue.component('setup-page', require('./components/setup/setup-page.vue'));
    
    /*
    |--------------------------------------------------------------------------
    | 
    |--------------------------------------------------------------------------
    | 
    | 
    | 
    | 
    |
    */


    $(document).ready(() => {

        $('.toggle-nav').on('click', () => {
            
            

            if($('.cms-navigation').is(":hidden")) {
                $('.body').removeClass('col-lg-12 col-md-12 col-sm-12 col-xs-12');
                $('.body').addClass('col-lg-10 col-md-10 col-sm-10 col-xs-10');
                setTimeout(() => {
                    $('.cms-navigation').animate({width:'toggle'}, 500);
                }, 500);
                // $('.body').removeClass('transition-normal');
            } else {
                $('.cms-navigation').animate({width:'toggle'}, 500, () => {
                    // $('.body').addClass('transition-normal');
                    $('.body').addClass('col-lg-12 col-md-12 col-sm-12 col-xs-12');
                    $('.body').removeClass('col-lg-10 col-md-10 col-sm-10 col-xs-10');
                });
    
            }
            
        });
        
    });

    $(document).ready(function() {
     
        $(window).resize(function(){
            
            // If there are multiple elements with the same class, "main"
            $('.__square__').each(function() {
                $(this).height($(this).width());
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
