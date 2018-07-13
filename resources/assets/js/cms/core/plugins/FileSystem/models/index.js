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

    import Folder from './folder';
    import Dossier from './dossier';
    
    let models = {
        folder: Folder,
        dossier: Dossier,
    };

    /*
    |--------------------------------------------------------------------------
    | Adding models to the window object
    |--------------------------------------------------------------------------
    |
    | The models are added to the window object so they are accessable everywhere.
    | 
    | 
    |
    */

    window.models = Object.assign(window.models, models);
    window.Folder = Folder;
    window.Dossier = Dossier;