import Model from '../core/models/Model';
import Validator from '../app/Validator/Validator';
import WalkThrough from '../app/WalkThrough/WalkThrough';

class Match extends Model {

    constructor(data = {}) {
        super(data);

        this.fields = {
            week_number: { 
				type: 'text', 
				translation: 'Weeknummer', 
				validation: new Validator({
					required: true,
				})
            },

        };

    }


}

export default Match;
