<template>

    <!-- Just the target container for dropzone to hook on to. -->
    <div style="max-width: 100%; min-width: 100%;" :id="identifier" class="col-lg-12 dropzone no-overflow"></div>
    
</template>

<style type="text/css">
    img {
        max-width: 100%;
    }
</style>

<script>

    import Uploader from '../App/Uploader';

    export default {
        props: {
            type: "",
            identifier: null
        },
        data() {
            return {
                uploader: null,
            }
        },

        mounted() {
            this.uploader = new Uploader(this.identifier);
            
            /**
             * wait for the entity to be persisted to the database. After that the model_id becomes available. 
             */
            Event.listen(this.type.toLowerCase() + ":added", (model) => {
                this.uploader.processQueue(model.id, this.type.toLowerCase());
            });
        },

    }
</script>
