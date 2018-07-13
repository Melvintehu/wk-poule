class InputController {

    /**
     * Boot method that can be implemented by sub classes to do some setup.
     */
    boot(){}

    /**
     * Sub classes can implement this method to make changes to the input, everytime it is referenced.
     * @param {*} input 
     */
    setInputAttribute(input) {
        this.input = input;
    }
    
    getInputAttribute() {
        return this.input;
    }

    /**
     * Events that can be implemented in the sub class
     */
    onChange() {}
    onReset() {};    
    onInsert() {}


    constructor(attributeName, attribute, value) {  
        this.progressBar = null;
        this.attributeName = attributeName;
        this.attribute = attribute;
        this.value = value;
        this.input = "";
        this.events = [];


        this.boot();

        this.registerListeners();

        setTimeout(() => {
            this.checkRequired();
        });
    }

    
    trackInput() {
        this.onChange();
        this.setInputAttribute(this.input);

        // Tell the CMS the input has changed.
        Event.fire('input:updated', { 
            input: this.input, 
            attributeName: this.attributeName 
        });
        
        // Do validation on the input's value.
        if(!Validator.valid(this.attribute.validation, this.input)) {
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
        this.onChange();        
        this.setInputAttribute(this.input);

        /**
         * The cms broadcasts when a new progressbar is initialised. We can add it to our inputController,
        * so we can call some functions on it.
        */
        Event.listen('progressBar:get', (progressBar) => {
            this.progressBar = progressBar;
        });
 
 
        /**
         * When this input is used in a edit context, we need to insert the corresponding value
        * by listening to this event, which passed us the correct value for this input.
        */
        Event.listen('input:insertValues', () => {      
            this.input = this.value[this.attributeName];
      
            this.onInsert(this.input);
            this.setInputAttribute(this.input);

            // Tell the CMS the input has changed.
            Event.fire('input:updated', { 
                input: this.input, 
                attributeName: this.attributeName 
            });
            
            // do validation
            if(Validator.valid(this.attribute.validation, this.input)) {
                this.progressBar.increment(this.attributeName);
            }

        });
 
        /**
         * 	Clear inputs when a new model is persisted.
        */
        Event.listen('inputs:clear', () => {
            this.input = "";
            this.onReset();

            this.progressBar.decrement(this.attributeName);
                
            this.checkRequired();
        });

        /**
         * 	When the save button is pressed, we check if this input meets the requirements 
        *	to be persisted to the database.
            */
        Event.listen('validator:validate', () => {
            this.setInputAttribute(this.input);
            
            Validator.valid(this.attribute.validation, this.input);
        });
     }
 
     
    /**
     * Checks if the input is required. 	
     */
    checkRequired() {
        if(!Validator.required(this.attribute.validation)) {
            this.progressBar.increment(this.attributeName);
        }
    }

}

export default InputController;