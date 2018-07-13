import Model from '../../../models/Model';
import Validator from '../../../../app/Validator/Validator';
import WalkThrough from '../../../../app/WalkThrough/WalkThrough';

class Newsletter extends Model {

    constructor(data = {}) {
        super(data);

        this.fields = {
            name: {
                type: 'text',
                translation: 'Naam',
                validation: new Validator({
                    required: true,
                }),
            },

            // email: {
            //     type: 'text',
            //     translation: 'Email',
            //     validation: new Validator({
            //         required: true
            //     }),
            // }, 

            photo: {
                type: 'photo',
                translation: 'Kies een foto',
                dimensions: {"1x1": 'portrait'},
                validation: new Validator({
                    required: true
                }),
            },
        };

    }
}

export default Newsletter;