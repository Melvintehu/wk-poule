window.Exception = new class{
	constructor() {

	}

	isType(prop, type) {
		if(typeof(prop) !== type) {
	        return false;
	    }
	    return true;
	}
}