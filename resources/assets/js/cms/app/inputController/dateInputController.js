import InputController from './inputController';

class DateInputController extends InputController {
    
    boot() {
        this.year = "";
        this.month = "";
        this.day = "";

        this.createFinalDate();
    }

    onChange() {
        this.createFinalDate();
    }

    onInsert(input) {
        let values = input.split("-");
        this.year = values[0];
        this.month = values[1];
        this.day = values[2];

        this.createFinalDate();
    }

    onReset() {
        this.year = "";
        this.month = "";
        this.day = "";
    }
    
    createFinalDate() {
        if(this.day === "" || this.month === "" || this.year === "") {
            this.input = "";
        } else {
            this.input = this.year + '-' + this.month + '-' + this.day;
        }
    }
}
    
    
export default DateInputController;
    