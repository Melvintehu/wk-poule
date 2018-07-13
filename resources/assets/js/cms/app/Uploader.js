class Uploader {

	constructor(identifier) {
		Dropzone.autoDiscover = false;
		this.init(identifier);
	}

	init(identifier) {
		
		let _this = this;

		$(document).ready(function() {

			// create a new dropzone programmatically and attach it to the div with the given id.
			this.dropzone = new Dropzone("div#" + identifier, { url: "/photo"});
			
			this.dropzone.options.autoProcessQueue = false;
			this.dropzone.options.headers = { "X-CSRF-TOKEN": Laravel.csrfToken };
			
			this.dropzone.options.maxFileSize = 200000000;
			this.dropzone.options.acceptedFiles = 'image/*';
	

			this.dropzone.options.maxFiles = 1;
			// remove the file after the upload of the file has finished
			
			this.dropzone.on('addedfile', () => {
				Event.fire('file:ready');
			});

			this.dropzone.on('error', (errorMessage) => {
				Event.fire('file:failed');
				Notifier.warning('Bestandsformaat wordt niet ondersteund. Ondersteunde bestandsformaten: .jpg, .png, .jpeg', errorMessage);
			});

			// handle the response if the file is uploaded
			this.dropzone.on('success', (file, response) => {
				_this.handleResponse(response);
			})

			this.dropzone.on('complete', (file) => {
				this.dropzone.removeFile(file);
			});

		});
	}

	//  Handle the response
	handleResponse(response) {

		let photo = {
			id: response.id,
			model_id: response.model_id,
			type: response.type,
			filename: response.filename
		}

		Event.fire('file:uploaded', photo);
		Event.fire('overlay:open');
	}

	// process all queued files 
	processQueue(model_id, model_type) {
		$(document).ready(function() {
			this.dropzone.options.params = {
				"model_id": model_id,
				"model_type": model_type,
			}

			this.dropzone.processQueue();
		});
	}


}

export default Uploader;