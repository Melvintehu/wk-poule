<template>
<div>
</div>
</template>

<script>
    export default {
        props: {
            id: "",
            model_id: "",
            type: "",
            filename: ""
        },
        mounted() {

            let photo = {
                id: this.id,
                model_id: this.model_id,
                type: this.type,
                filename: this.filename
            };

            Event.fire('setCropper', photo);
        }
    }
</script>
