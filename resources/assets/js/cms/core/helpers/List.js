new class{

	constructor() {
		this.list = [];
	}


	add(item) {
		let object = {};
		if(typeof yourVariable === 'object') {
			for(let field in item) {
				object[field] = item[field];
			}
		}
		this.list.push(object);
	}

	pop() {
		return this.list.pop();
	}



	get(index) {
		return this.list[index];
	}




}