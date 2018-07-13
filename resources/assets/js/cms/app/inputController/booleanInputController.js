import InputController from './inputController';

class BooleanInputController extends InputController{
    
    boot() {
        this.input = false;
        
        Event.fire('input:updated', {
            input: this.input, 
            attributeName: this.attributeName,
        });
    }
    
    /**
     * Everytime the input gets a new value, we get a chance to change it by implementing this method. 
     * @param {*} input 
     */
    setInputAttribute(input) {
        this.input = input ? 1: 0;
    }
    

    onReset() {
        this.input = false;
    }


}


export default BooleanInputController;
    