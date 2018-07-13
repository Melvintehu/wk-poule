<template>
<div v-if="inputController !== null" @keyup.9.capture.prevent.stop>
	
	<!-- Attribute title and walkThrough -->
	<attribute-title :attribute="attribute"></attribute-title>
	
	<textarea
		
		@keyup="inputController.trackInput();"
		:id="attributeName + identifier"
		v-model="inputController.input"
		

		class="
			border border-secondary border-curved outline-none
			space-inside-sides-md space-inside-sm
			inline-block
			bg-secondary
			" :placeholder="attribute.translation" style="height: 150px; width: 100%; resize: none;"  :name="attributeName"  required></textarea>
	<!-- A display to display the errors -->
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