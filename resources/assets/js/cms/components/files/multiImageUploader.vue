<template>

    <!-- Just the target container for dropzone to hook on to. -->
    <div style="max-width: 100%; min-width: 100%;" id="dropzone" class="col-lg-12 dropzone no-overflow"></div>
    
</template>

<script>
    // class to handle multiple photo uploads
    import MultiPhotoUploader from '../../app/MultiPhotoUploader/multiPhotoUploader';

    export default {
        props: {
            type: null,
        },

        data() {
            return {
                uploader: null,
            }
        }, 

        mounted() {
            this.uploader = new MultiPhotoUploader();

            /**
             * wait for the entity to be persisted to the database. After that the model_id becomes available. 
             */
            Event.listen(this.type.toLowerCase() + ":added", (model) => {
     
                // this.uploader.processQueue(model.id, this.type.toLowerCase());
            });
            
        },

        methods: {
            
        }
    }    
</script>