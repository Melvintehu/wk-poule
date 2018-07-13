import InputController from './inputController';

class ModelInputController extends InputController {
            
        boot() {
            this.optionValues = [];
            this.getModelOptionValues();
        }

        /**
         * Get the associated model's values from the database.
         */
        getModelOptionValues() {
            $(document).ready(() => {
            
            Factory.getStaticInstance(this.attribute.model)
                   .all()
                   .then((objects) => {
                              
                           this.optionValues = _.map(objects, (object) => {
                               return {
                                   id: object.id, 
                                   value: object[this.attribute.referenceField]
                               }
                           });
                    });
            });	
        }
    }
    
    
    export default ModelInputController;
    