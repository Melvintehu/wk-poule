window.Factory = new class{
	
	constructor() {
		this.classNames = [];
	}

	getInstanceOf(className, data = null) {   
		
        className = Helper.lcfirst(className);
        
		return new models[className](data);
	}

	getStaticInstance(className) {
        className = Helper.lcfirst(className);
        this.classNames.push(className);
        
		return models[className];
	}
}