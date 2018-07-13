<template>
<div>
	<div>
 		<input-renderer-update :object="object"> </input-renderer-update>
 	</div>
</div>	
</template>

<style type="text/css">
	
</style>


<script type="text/javascript">

	require('../../Objects');

	export default {
        props: {
        	type: null,
        },
        data() {
            return {
            	object: new models[this.type](),
            }
        },
        mounted() {
        	Event.listen('input:update', () => {
        		this.update();
        	});
        },
        methods: {
        	update() {
        		let object = new models[this.type]();

        		for(let field in this.object.fields) {
					
					object[field] = $('#' + field)[0].value		
				}

				delete object.fields

				object.update(this.type, () => {
					Event.fire(this.type + ':updated');
				});
        	},
        }
    }

</script>