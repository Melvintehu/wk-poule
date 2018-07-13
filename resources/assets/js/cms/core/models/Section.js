import Model from './Model';
import Validator from '../../app/Validator/Validator';
import WalkThrough from '../../app/WalkThrough/WalkThrough';


class Section extends Model {

    constructor(data = {}) {
        super(data);

        this.fields = {

            title: {
                type: 'text',
                translation: 'Titel',
                validation: new Validator({
                    required: true,
                }),

                sortBy: 'alphabetical',
            },

            
            body: {
                type: 'textarea',
                sortBy: 'alphabetical',
                translation: 'Beschrijving',
                validation: new Validator({ required: true }),
            },

        };

    }


}

export default Section;
