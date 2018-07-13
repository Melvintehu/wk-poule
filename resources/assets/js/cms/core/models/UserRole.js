import Model from './Model';
import Validator from '../../app/Validator/Validator';
import WalkThrough from '../../app/WalkThrough/WalkThrough';

class UserRole extends Model {

    constructor(data = {}) {
        super(data);

        this.fields = {
            name: {
                type: 'text',
                translation: 'Rolnaam',
                validation: new Validator({
                    required: true,
                }),
                walkThrough: new WalkThrough([
                    "In de websitebeheertool kunt u verschillende beheerdersrollen aanmaken. " +
                    "Met deze beheerdersrollen kunt u de toegang tot verschillende delen van de websitebeheertool beperken." + 
                    "Deze rollen kunnen enkel door de hoofdbeheerder( uzelf ) worden toegevoegd. ",
                ]),
            },
            
            title: {
                type: 'text',
                translation: 'Titel',
                validation: new Validator({
                    required: true,
                }),

                
            },

            level: {
                type: 'text',
                translation: 'level',
                validation: new Validator({
                    required: true,
                }),
            },
            
            
        };

    }


}

export default UserRole;
