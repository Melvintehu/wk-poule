class Validator{

	constructor(validationRules) {
		this.validationRules = validationRules;
		this.errors = {};
	}


	reset() {
		this.errors = {};
	}

}

export default Validator;

