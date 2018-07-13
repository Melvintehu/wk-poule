window.Validator = new class{


	constructor() {
		
	}

	reset(validator) {
		if(validator !== undefined) {
			validator.errors = {};
		}
	}

	valid(validator, value = null) {
		if(validator === undefined) {
			return true;
		}

		validator.errors = {};

		if(validator.validationRules.max_string_length !== undefined) {
			if(value.length > validator.validationRules.max_string_length) {
				validator.errors.max_string_length = 'De lengte van de ingevoerde tekst is te lang';
			}
		}


		if(validator.validationRules.min_string_length !== undefined) {
			if(value.length < validator.validationRules.min_string_length) {
				validator.errors.min_string_length = 'De lengte van de ingevoerde tekst is te kort, de tekst moet minimaal ' + validator.validationRules.min_string_length + ' tekens lang zijn.';
			}
		}

		if(validator.validationRules.required !== undefined) {
			if(value.length === 0) {
				validator.errors.required = 'U heeft dit veld nog niet ingevuld.';
			}
		}

		if(validator.validationRules.numeric !== undefined) {
			if(!this.validateIsNumeric(value) && validator.validationRules.numeric) {
				validator.errors.required = "Dit veld mag alleen cijfers en '.' hebben";
			}
		}

		if(validator.validationRules.type !== undefined) {
			if(validator.validationRules.type === 'email') {
				if(!this.validateEmail(value)) {
					
					validator.errors.type = 'Het ingevoerde emailadres is nog niet correct. Voorbeeld: admin@mentechmedia.nl';
				}
			}

			if(validator.validationRules.type === 'phoneNumber') {
				if(!this.validatePhoneNumber(value)) {
					validator.errors.type = 'Het ingevoerde telefoonnummer is nog niet correct. Voorbeeld: 0612345678 of 0512123456';
				}
			}

			/**
			 * Validate if it is a youtube link.
			 */
			if(validator.validationRules.type === 'youtube') {
				if(!this.validateYoutubeLink(value)) {
					validator.errors.type = 'De ingevoerde youtube link is niet correct.';
				}
			}
		}


		if(Object.keys(validator.errors).length > 0) {
			return false;
		}

		return true;	
	}

	required(validator) {
		if(validator === undefined) {
			return false;
		}

		if(validator.validationRules.required !== undefined) {
			return validator.validationRules.required;
		}
	}


	// Validators	

	validateYoutubeLink(url) {
		var p = /^(?:https?:\/\/)?(?:www\.)?(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=|watch\?.+&v=))((\w|-){11})(?:\S+)?$/;
		return (url.match(p)) ? RegExp.$1 : false;
	}

	validateEmail(email) {
	    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	    return re.test(email);
	}

	validatePhoneNumber(phoneNumber) {  
	  	var re = /^\d{10}$/;
		return re.test(phoneNumber);
	}  

	validateIsNumeric(number) {
		var isnum = /^\d+$/;
		return isnum.test(number);
	}


}