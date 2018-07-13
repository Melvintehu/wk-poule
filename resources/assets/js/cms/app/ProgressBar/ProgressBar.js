class ProgressBar {
    constructor(totalInputs) {
        this.totalInputs = totalInputs;
        this.completed = {};
        this.completedInputs = 0;
        this.currentWidth = '1';
    }

    increment(key) {
        this.completed[key] = true;
        this.updateProgressbar();
    }

    decrement(key) {
        this.completed[key] = false;
        this.updateProgressbar();
    }

    /**
     * Broadcast to all inputs that there is a progressBar, send the progressBar to all inputs.
     */
    broadcastProgressBar() {
        setTimeout(() => {
            Event.fire('progressBar:get', this);
        });
    }

    updateProgressbar() {

        // we recount all the fields that are filled in 
        this.completedInputs = _.sumBy(this.completed, (complete) => {
            return completed? 1:0;
        });

        for(let attribute in this.completed) {
            if(this.completed[attribute]) {
                this.completedInputs++;
            }
        }

        // we calculate the percentage
        this.currentWidth = ((100 / this.totalInputs) * this.completedInputs) + '';
        // if the percentage is @ 0% we change it to 1%
        if(this.currentWidth === '0') {
            this.currentWidth = '1';
        }
    }


    reset() {
        this.completed = {};
        this.completedInputs = 0;  
    
    }

    roundPercentage(percentage) {
        return Helper.roundPercentage(percentage) 
    }

    isComplete() {
        let total = 0;

        for(let index in this.completed) {
            if(this.completed[index]) {
                total++;
            }
        }
        
        return total === this.totalInputs;
    }
}

export default ProgressBar;