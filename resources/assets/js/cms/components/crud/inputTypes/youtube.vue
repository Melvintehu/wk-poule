<template>

	<div v-if="inputController !== null" @keyup.9.capture.prevent.stop class="full-width">
	
		<!-- Attribute title and walkThrough. -->
		<attribute-title :attribute="attribute"></attribute-title>
		
		<!-- A prefix for a text based input. -->
		<p class="inline-block reset-padding space-inside-sides-md bg-tertiary text-color-light space-inside-sm">Youtube link</p>

		<!-- The input -->
		<input 
			@keyup="inputController.trackInput();"
			:id="attributeName + identifier"
			:placeholder="attribute.translation"
			v-model="inputController.input"
			
			class="
				reset-padding
				border border-secondary border-right-curved outline-none
				space-inside-sides-md space-inside-sm 
				inline-block 
				bg-secondary
				" 
            style="width: 30%;"
			type="text" 
			:name="attributeName"
		>
		
		<!-- A display to display the errors. -->
		<validation-display v-if="attribute.validation !== undefined" :errors="attribute.validation.errors"> </validation-display>

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