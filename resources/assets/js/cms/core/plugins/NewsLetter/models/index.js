    /*
    |--------------------------------------------------------------------------
    | Plugin model imports
    |--------------------------------------------------------------------------
    |
    | Import the plugin models here.
    |
    | 
    |
    */

    import Newsletter from './Newsletter';

        
    let models = {
        newsletter: Newsletter,
    };


    window.models = Object.assign(window.models, models);
    window.Newsletter = Newsletter;
