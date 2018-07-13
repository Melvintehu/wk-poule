<template>
<div v-if="inputController !== null">
	<attribute-title :attribute="attribute"></attribute-title>

	<!-- select input -->
	
		
	<select  
		@change="inputController.trackInput()" 
		v-model="inputController.input"
		style="height: 50px" 
		:id="attributeName + identifier"  
		class="border-curved space-inside-xs outline-none text-color-accent space-inside-sides-sm full-width border-secondary bg-secondary border" >

		<option disabled  style="bg-main" class="bg-main text-color-light" value="">Maak een keuze</option>

		<option 
			v-if="value !== undefined && optionValue.id === value[attributeName]" 
			selected=selected 
			v-for="optionValue in inputController.optionValues"  
			:value="optionValue.id" >{{ optionValue.value }}</option>

		<option 
			v-if="value === undefined  || optionValue.id !== value[attributeName]" 
			v-for="optionValue in inputController.optionValues"  
			:value="optionValue.id" >{{ optionValue.value }}</option>

	</select>


	<!-- A display to display the errors -->
	 <validation-display  v-if="attribute.validation !== undefined" :errors="attribute.validation.errors"> </validation-display>


</div>
</template>


<script type="text/javascript">

	import SelectInputController from '../../../app/inputController/SelectInputController';

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
			
			this.inputController = new SelectInputController(this.attributeName, this.attribute, this.value);
		
		},


	}
</script>