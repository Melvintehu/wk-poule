class PhotoInputController {
    
    
        constructor(attribute) {
            this.progressBar = null;
            this.attribute = attribute;
            
            // diff
            this.photo = null;
            
            
            this.registerListeners();
            this.checkRequired();
        }   
    
        /**
         * register listeners here. 	
         */
        registerListeners() {

            /**
             * The cms broadcasts when a new progressbar is initialised. We can add it to our inputController,
             * so we can call some functions on it.
             */
            Event.listen('progressBar:get', (progressBar) => {
                this.progressBar = progressBar;
            });


            /**
             * When this input is used in a edit context, we can always increment the progressbar, since either the 
             * photo is set, or not mendatory. In both cases the progressbar should be incremented for the photo input.
             * 
             */
            Event.listen('input:insertValues', () => {
                this.progressBar.increment('photo');
            });

            /**
             * When the uploaded file is ready for upload, we can increment the progressbar.
             */
            Event.listen('file:ready', () => {
                this.progressBar.increment('photo');
            });

            Event.listen('overlay:closing', () => {
                this.photo = null;
            });

            /**
             * When the file is done uploading to the server, we can store it in the photos array.
             */
            Event.listen('file:uploaded', (photo) => {
                this.photo = photo;
            });

            Event.listen('inputs:clear', () => {
                this.progressBar.decrement('photo');
                this.checkRequired();
            });
        }
    
        /**
         * Checks if the photo is required. 	
         */
        checkRequired() {
            if(!Validator.required(this.attribute.validation)) {
                this.progressBar.increment('photo');
            }
        }
}
    
    
    export default PhotoInputController;
    