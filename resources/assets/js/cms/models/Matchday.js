import Model from '../core/models/Model';
import Validator from '../app/Validator/Validator';
import WalkThrough from '../app/WalkThrough/WalkThrough';

class Matchday extends Model {

    constructor(data = {}) {
        super(data);

        this.fields = {
            match_day: { 
				type: 'date', 
				translation: 'Speeldag', 
				validation: new Validator({
					required: true,
				})
            },

        };

    }


}

export default Matchday;
