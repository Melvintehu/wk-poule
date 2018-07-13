class Sortable {

    getTypes() {
        return {
            alphabetical: {                
                'A-Z': 'alphabetical',
                'Z-A': 'alphabetical',
            },
            numerical: {
                'Laag - Hoog': 'numerical',
                'Hoog - Laag': 'numerical',
            },
        };
    }

    constructor(data) {
        this.data = data;
        this.initialized = false;
        this.selectedSortType = '';
        this.options = {};
        
        this.types = this.getTypes();
    }

    /**
     * Finds all the sortable options that have been set in the object's fields
     * @param {*} object 
     */
    findSortableOptions(object) {
        for(let index in object.fields) {

            let attribute = object.fields[index];
            
            if(attribute.sortBy !== undefined && this.types[attribute.sortBy] !== undefined) {
                this.activateOption(attribute.sortBy);
            }

        }
        this.flatten();
        this.initialized = true;
    }

    flatten() {
        let temp = {};

        for(let index in this.options) {
            let option = this.options[index];

            for(let key in option) {
                temp[key] = option[key];
            }
        }
        this.options = temp;
   
    }


    /**
     * adds a sort method to the options array
     * @param {*} sortBy 
     */
    activateOption(sortBy) {
        
        if(this.options[sortBy] === undefined) {
            this.options[sortBy] = this.types[sortBy];
        }
    }

    /**
     * Sorts the data based upon the selected sort option
     */
    sort() {
        
        // implement sort function
        // this.broadCastChanges(this.data);
    }


    /**
     * Broadcast any changes that have been made to the data.
     * @param {*} data 
     */
    broadCastChanges(data) {
        Event.fire('sortable:changed', data);
    }

}

export default Sortable;