<template>
	<div v-if="inputController !== null" @keyup.9.capture.prevent.stop>
	
		<!-- Attribute title and walkThrough -->
		<attribute-title :attribute="attribute"></attribute-title>

		<!-- The input -->
		<input 
			@keyup="inputController.trackInput();"
			:placeholder="attribute.translation"
			v-model="inputController.input"
			
			class="
				border border-secondary border-curved outline-none
				space-inside-sides-md space-inside-sm 
				inline-block 
				full-width
				bg-secondary
				" 
		required>
		
		<!-- A display to show the errors on the screen -->
		<validation-display  v-if="attribute.validation !== undefined" :errors="attribute.validation.errors"> </validation-display>

	</div>
</template>

<script type="text/javascript">
	import TextInputController from '../../../app/inputController/textInputController';

	export default {
		props: {
			attributeName: null,
			attribute: null,
			identifier: null,
			value: "",
		}, 

		data() {
			return {
				inputController: null,
			}
		},

		mounted() {
			this.inputController = new TextInputController(this.attributeName, this.attribute, this.value);
		},

	}
</script>