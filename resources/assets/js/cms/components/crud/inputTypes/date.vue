<template>
	<div v-if="dateInputController !== null" @keyup.9.capture.prevent.stop>
		
		<attribute-title :attribute="attribute"></attribute-title>

		<p min="1" max="31" class="inline-block reset-padding space-inside-sides-md bg-tertiary text-color-light space-inside-sm">dag</p>
		<input v-model="dateInputController.day" @keyup="dateInputController.trackInput()" :id="'dag' + attributeName + identifier" class="
			reset-padding
			border border-secondary border-right-curved outline-none
			space-inside-sides-md space-inside-sm 
			inline-block 
			
			bg-secondary
			"  style="width: 10%" type="number" placeholder="dag" name="">
		<p class="inline-block reset-padding space-inside-sides-md bg-tertiary text-color-light space-inside-sm">maand</p>
		<input v-model="dateInputController.month" min="1" max="12" @keyup="dateInputController.trackInput()" :id="'maand' + attributeName + identifier" class="
			reset-padding
			border border-secondary border-right-curved outline-none
			space-inside-sides-md space-inside-sm 
			inline-block 
			
			bg-secondary
			"  style="width: 10%" type="number" placeholder="maand" name="">
		<p class="inline-block reset-padding space-inside-sides-md bg-tertiary text-color-light space-inside-sm">jaar</p>
		<input v-model="dateInputController.year" @keyup="dateInputController.trackInput()" :id="'jaar' + attributeName + identifier" class="
			reset-padding
			border border-secondary border-right-curved outline-none
			space-inside-sides-md space-inside-sm 
			inline-block 
			
			bg-secondary
			"  style="width: 10%" type="number" placeholder="jaar" name="">

			<input 
				:id="attributeName + identifier" 
				type="hidden"  
				:name="attributeName"
				v-model="dateInputController.input"
			>

			 <!-- A display to display the errors -->
	 		<validation-display  v-if="attribute.validation !== undefined" :errors="attribute.validation.errors"> </validation-display>
	</div>
</template>

<script type="text/javascript">
	import DateInputController from '../../../app/inputController/dateInputController';

	export default {
		props: {
			attributeName: null,
			attribute: null,
			identifier: null,
			value: "",
		}, 

		data() {
			return {
				dateInputController: null,
			}
		},

		mounted() {
			this.dateInputController = new DateInputController(this.attributeName, this.attribute, this.value);
		},

	}
</script>