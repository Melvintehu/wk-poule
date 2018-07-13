import Model from './Model';
import Validator from '../../app/Validator/Validator';

class Entity extends Model {

    constructor(data = {}) {
        super(data);

        this.fields = {
            // id: {
            //     type: 'number',
            //     translation: 'Identifier',
            //     description: 'Unieke ID',
            //     sortBy: 'numerical',
            // },

            name: {
                type: 'text',
                translation: 'Naam van de entiteit',
                description: 'Naam',
                sortBy: 'alphabetical',
                validation: new Validator({
                    required: true,
                }),

            },
            nav_group_id: {
                type: 'model',
                model: 'navGroup',
                referenceField: 'name',
                translation: 'Behoort tot Navigatiegroep',
                description: 'Navigatie groep',
                validation: new Validator({
                    required: true
                }),
            },
            
            title: {
                type: 'text',
                translation: 'Title cms',
                description: 'Titel',
                sortBy: 'alphabetical',
                validation: new Validator({
                    required: true
                }),
            },

            description: {
                type: 'textarea',
                translation: 'Beschrijving voor de entiteit',
                description: 'Beschrijving',
                sortBy: 'alphabetical',
                validation: new Validator({
                    required: true,
                }),
            },

            icon: {
                type: 'icon',
                translation: 'Kies een material design icon',
                description: 'Icon',
                validation: new Validator({
                    required: true
                }),
            },


           

        
           
        };

    }


}

export default Entity;