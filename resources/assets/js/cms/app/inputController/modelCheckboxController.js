class ModelCheckboxController {


    constructor(attributeName, attribute,  value) {
        this.progressBar = null;
        
        this.selectedCheckboxes = {};
        this.checkboxes = [];

        this.loading = true;

        this.attributeName = attributeName;
        this.attribute = attribute;
      
        // In edit context
        this.value = value;
      
        this.registerListeners();
        this.checkRequired();
        this.checkboxValues();
    }

    checkboxValues() {
        Factory.getStaticInstance(this.attribute.model)
        .all()
        .then((objects) => {
            this.checkboxes = _.map(objects, (object) => {
                return {
                    id: object.id,
                    value: object[this.attribute.referenceField]
                }
            });

         });
    }


    trackInput() {
        let selected = [];
   
        for(let index in this.selectedCheckboxes) {
            let checkbox = this.selectedCheckboxes[index];

            if(checkbox) {
                selected.push(index);
            }
        }   
        
        this.loading = false;

        // Tell the CMS the input has changed.
        Event.fire('input:updated:' + this.attributeName, selected);
        
        // Do validation on the input's value.
        if(selected.length === 0) {
            this.progressBar.decrement(this.attributeName);            
            return;
        } 

        // if nog validation error, we tell the progressbar to increment.
        this.progressBar.increment(this.attributeName);
    }



    /**
     * register listeners here. 	
     */
    registerListeners() {
       

        /**
         * The cms broadcasts when a new progressbar is initialised. We can add it to our inputController,
         * so we can call some functions on it.
         */
         Event.listen('progressBar:get', (progressBar) => {
             this.progressBar = progressBar;
         });

         Event.listen('input:insertValues', ()  => {
          
            this.attribute.selected.then((data) => {
               
                for(let index in data) {
                    let value = data[index];
                    
                    this.selectedCheckboxes[value.id] = true;
                    this.trackInput();
                }
            });
         });
  

        /**
         * 	Clear inputs when a new model is persisted.
         */
        Event.listen('inputs:clear', () => {
            this.selectedCheckboxes = [];

            this.progressBar.increment(this.attributeName);
        });

        /**
         * 	When the save button is pressed, we check if this input meets the requirements 
         *	to be persisted to the database.
        */
        Event.listen('validator:validate', () => {
            Validator.valid(this.attribute.validation, this.input);
        });

    }

    /**
     * Checks if the input is required. 	
     */
    checkRequired() {
        if(!Validator.required(this.attribute.validation, this.input)) {
            this.progressBar.increment(this.attributeName);
        }
    }
}


export default ModelCheckboxController;
