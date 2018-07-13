class MultiUploader {

	constructor(identifier) {
		Dropzone.autoDiscover = false;
		this.init(identifier);
	}

	init(identifier) {
		
		let _this = this;

		$(document).ready(function() {

			// create a new dropzone programmatically and attach it to the div with the given id.
			this.dropzone = new Dropzone("div#" + identifier, { url: "/photo/multi"});
			
			this.dropzone.options.autoProcessQueue = false;
			this.dropzone.options.headers = { "X-CSRF-TOKEN": Laravel.csrfToken };
			
			this.dropzone.options.maxFileSize = 20000;
			this.dropzone.options.acceptedFiles = 'image/*';
    
            this.dropzone.options.uploadMultiple = true;

			this.dropzone.options.maxFiles = 10;
			this.dropzone.options.parallelUploads = 10;
			// remove the file after the upload of the file has finished
			
			this.dropzone.on('addedfile', () => {
				Event.fire('file:ready');
			});

			this.dropzone.on('error', (errorMessage) => {
				Event.fire('file:failed');
				Notifier.warning('Bestandsformaat wordt niet ondersteund. Ondersteunde bestandsformaten: .jpg, .png, .jpeg', errorMessage);
			});

			// handle the response if the file is uploaded
			this.dropzone.on('successmultiple', (files, response) => {
				_this.handleResponse(response);
			})

			this.dropzone.on('completemultiple', (files) => {
				console.log('CompleteMultiple');
				for(let file in files){
					this.dropzone.removeFile(file);
				}
			});

		});
	}

	//  Handle the response
	handleResponse(response) {


        let photoArray = [];

        for(let responsePhoto of response){
            let photo = {
                id: responsePhoto.id,
                model_id: responsePhoto.model_id,
                type: responsePhoto.type,
                filename: responsePhoto.filename
            }
            photoArray.push(photo);
        }

		Event.fire('files:uploaded', photoArray);
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

export default MultiUploader;