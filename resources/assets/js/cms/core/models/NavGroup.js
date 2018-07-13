import Model from './Model';
import Validator from '../../app/Validator/Validator';
import WalkThrough from '../../app/WalkThrough/WalkThrough';

class NavGroup extends Model {

    constructor(data = {}) {
        super(data);

        this.fields = {
            name: {
                type: 'text',
                translation: 'Naam van de navigatiegroep',
                validation: new Validator({
                    required: true,
                }),

            },
           
        };

    }


}

export default NavGroup;