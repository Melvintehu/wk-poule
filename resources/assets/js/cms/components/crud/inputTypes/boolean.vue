<template>
<div v-if="inputController !== null" class="space-inside-down-md">

	<!-- Attribute title and walkThrough -->
	<attribute-title :attribute="attribute"></attribute-title>

	<div class="col-lg-2 ">
						
			<p class="space-inside-down-xs">actief & inactief</p>

			<div class="checkboxOne">		
				<input 
					@change="inputController.trackInput()"
					v-model="inputController.input"
					type="checkbox"  
					:id="attributeName + identifier"
					:name="attributeName + identifier"
				/>
				<label :for="attributeName + identifier"> </label>
			</div>

	
	</div>

	<!-- A display to display the errors -->
	<validation-display  v-if="attribute.validation !== undefined" :errors="attribute.validation.errors"> </validation-display>
    
</div>
</template>
<style type="text/css">
	.checkboxOne {
		width: 40px;
		height: 10px;
		background: #F3A119;
		position: relative;
		border-radius: 3px;
	}


	/**
 * Create the slider from the label
 */
.checkboxOne label {
	display: block;
	width: 16px;
	height: 16px;
	border-radius: 50%;

	transition: all .5s ease;
	cursor: pointer;
	position: absolute;
	top: -3px;
	left: -3px;

	background: #F6F6F6; ;
}


.checkboxOne input[type=checkbox]:checked + label {
	left: 27px;
	background: #354052;
}



input[type=checkbox] {
	visibility: hidden;
}


</style>

<script type="text/javascript">

	import BooleanInputController from '../../../app/inputController/booleanInputController';

	
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
			this.inputController = new BooleanInputController(this.attributeName, this.attribute, this.value);
		},

	

        

	}
</script>