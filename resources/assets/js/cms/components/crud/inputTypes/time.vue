<template>
	<div v-if="timeInputController !== null" @keyup.9.capture.prevent.stop>
	
		<!-- Attribute title and walkThrough -->
		<attribute-title :attribute="attribute"></attribute-title>
		
		<p  class="inline-block reset-padding space-inside-sides-md bg-tertiary text-color-light space-inside-sm">uur</p>
		<input v-model="timeInputController.hour" @keyup="timeInputController.trackInput()" :id="'uur' + attributeName + identifier" class="
			reset-padding
			border border-secondary border-right-curved outline-none
			space-inside-sides-md space-inside-sm 
			inline-block 
			bg-secondary
			"  style="width: 10%" type="number" placeholder="uur" name="">
		<p class="inline-block reset-padding space-inside-sides-md bg-tertiary text-color-light space-inside-sm">minuten</p>
		<input v-model="timeInputController.minutes"  @keyup="timeInputController.trackInput()" :id="'minuten' + attributeName + identifier" class="
			reset-padding
			border border-secondary border-right-curved outline-none
			space-inside-sides-md space-inside-sm 
			inline-block 
			bg-secondary
			"  style="width: 10%" type="number" placeholder="minuten" name="">
		
		<input 
				:id="attributeName + identifier" 
				type="hidden"  
				:name="attributeName"
				v-model="timeInputController.input"
			>
		<!-- A display to display the errors -->
	 <validation-display  v-if="attribute.validation !== undefined" :errors="attribute.validation.errors"> </validation-display>
	</div>
</template>

<script type="text/javascript">
	import TimeInputController from '../../../app/inputController/timeInputController';

	export default {
		props: {
			attributeName: null,
			attribute: null,
			identifier: null,
			value: "",
		}, 

		data() {
			return {
				timeInputController: null,
			}
		},

		mounted() {
			this.timeInputController = new TimeInputController(this.attributeName, this.attribute, this.value);
		},

	}
</script>