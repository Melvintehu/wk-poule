class MultiPhotoUploader {
    
    constructor() {
        Dropzone.autoDiscover = false;
        this.init();    
    }


    init() {

        let $this = this;
        
        $(document).ready(() => {

            this.dropzone = this.dropzone();
            this.dropzone.options.acceptedFiles = 'image/*';

            this.setAutoProcessing(false);
            
            this.setHeaders({
                "X-CSRF-TOKEN": Laravel.csrfToken,
            });

            this.setMaxFileSize(20000);

            
			this.dropzone.on('addedfile', () => {
           
				Event.fire('file:ready');
			});

            
        });

    }

    dropzone() {
        return new Dropzone("div#dropzone", { url: "/photo/multi"});
    }

    setAutoProcessing(autoProcess) {
        this.dropzone.options.autoProcessQueue = autoProcess;
    }

    setHeaders(headers) {
        this.dropzone.options.headers = headers;
    }

    setMaxFileSize(fileSize) {
        this.dropzone.options.maxFileSize = fileSize;
    }

}

export default MultiPhotoUploader;