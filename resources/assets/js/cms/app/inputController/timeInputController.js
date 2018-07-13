import InputController from './inputController';

class TimeInputController extends InputController{
    
    boot() {
        this.hour = "";
        this.minutes = "";

        this.createFinalTime();
    }

    onChange() {
        this.createFinalTime();            
    }

    onInsert(input) {
        let values = input.split(":");
        this.hour = values[0];
        this.minutes = values[1];

        this.createFinalTime();
    }

    onReset() {
        this.hour = "";
        this.minutes = "";
    }    

    createFinalTime() {
        if(this.hour === "" || this.minutes === "" ) {
            this.input = "";
        } else {
            this.input = this.hour + ':' + this.minutes;
        }
    }
}
    
    
export default TimeInputController;
    