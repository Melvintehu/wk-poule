class Factory {
	
	constructor() {
		this.classNames = [];
	}

	getInstanceOf(className, data = null) {        
        className = Helper.lcfirst(className);
		this.classNames.push(className);
        
		return new models[className](data);
	}

	getStaticInstance(className) {
        className = Helper.lcfirst(className);
        this.classNames.push(className);
        
		return models[className];
	}
}

export default Factory;