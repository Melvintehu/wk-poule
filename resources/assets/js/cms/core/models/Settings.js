import Model from './Model';
import Validator from '../../app/Validator/Validator';
import WalkThrough from '../../app/WalkThrough/WalkThrough';

class Settings extends Model {

    constructor(data = {}) {
        super(data);

        this.fields = {
            setup: {
                type: 'boolean',
                translation: 'Installatie afgerond?',
                validation: new Validator({
                    required: false,
                }),
            },

            project_name: {
                type: 'time',
                translation: 'Projectnaam',
                description: 'Projectnaam',
                validation: new Validator({
                    required: true
                }),
            },

            user_id: {
                type: 'model',
                model: 'user',
                referenceField: 'name',
                translation: 'Hoofdgebruiker van CMS',
                description: 'Hoofdgebruiker van CMS',
                validation: new Validator({
                    required: true
                }),
            },

            max_amount_users: {
                type: 'number',
                translation: 'Maximaal aantal gebruikers',
                validation: new Validator({
                    required: true,
                }),
            },

            subscription_valid_until: {
                type: 'date',
                translation: 'Abonnement geldig tot',
                validation: new Validator({
                    required: true,
                }),
            },

            yearly_fee: {
                type: 'number',
                translation: 'Jaarlijkse kosten',
                validation: new Validator({
                    required: true,
                }),
            },
        };

    }


}

export default Settings;