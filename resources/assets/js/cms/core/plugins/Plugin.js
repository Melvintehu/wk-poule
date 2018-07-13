class Plugin {

    constructor() {
        if (new.target === Plugin) {
            throw new TypeError("Cannot construct Abstract class Plugin");
        }
        this.boot();
    }

    boot() {
       throw new Error('Abstract method boot needs to be implemented.');
    }

}

export default Plugin;