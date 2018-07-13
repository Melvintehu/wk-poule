import InputController from './inputController';

class SelectInputController extends InputController {
            
        boot() {
            this.optionValues = [];
            this.getModelOptionValues();
        }

        /**
         * Get the associated model's values from the database.
         */
        getModelOptionValues() {
            $(document).ready(() => {
                
                this.optionValues = _.map(this.attribute.choices, (object, index) => {
                    return {
                        id: index, 
                        value: object
                    }                    
                });
                

            });
            
           
        }

    }
    
    
    export default SelectInputController;