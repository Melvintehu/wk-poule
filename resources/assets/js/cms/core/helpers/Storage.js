/**
 * A helper class. All components can use this class.
 * Provides one accespoint to common used functions
 * @type {Helper}
 */
window.Storage = new class {

    constructor() {
        this.storage = {};
        if(localStorage.getItem('__storage__') !== null) {
            this.storage = JSON.parse(localStorage.getItem('__storage__'));
        }
    }


    /**
    * store something in the localStorage
    *
    */
    set(key, value) {
        this.storage[key] = value;
        this.save();
    }


    /**
    * get something from the localStorage
    *
    */
    get(key) {
        if(this.storage[key] !== undefined) {
            return this.storage[key];
        }
        return null;
    }


    /**
    * check if key and value exist in the localStorage
    *
    */
    exists(key) {
        return new Promise((resolve, reject) => {
            if(this.storage[key] !== undefined && this.storage[key] !== null) {
                 resolve(this.storage[key]);
            } else {
                reject();
            }
        });
        
    }

    /**
    * remove something from the localStorage
    * returns the removed item
    */
    remove(key) {
        let item = this.storage[key];
        delete this.storage[key];
        this.save();
        return item;
    }


    /**
    * remove something from the localStorage
    * returns the removed item
    */
    save() {
        localStorage.setItem('__storage__', JSON.stringify(this.storage));
    }


}
