<template>
<div v-if="inputController !== null" class="space-inside-down-md">


	<attribute-title :attribute="attribute"></attribute-title>

	<div v-if="inputController.checkboxes.length !== 0 && !inputController.loading" v-for="checkbox in inputController.checkboxes" class="col-lg-2 ">
						
			<p class="space-inside-down-xs">{{checkbox.value}}</p>

			<div class="checkboxOne">		
				<input 
					
					@change="inputController.trackInput()"
					v-model="inputController.selectedCheckboxes[checkbox.id]"
					type="checkbox"  
					:id="checkbox.id + attributeName" 
					:name="attributeName"
				/>
				<label :for="checkbox.id + attributeName"> </label>
			</div>
	</div>

	<p class="space-inside-sides-sm text-danger text-bold font-md" v-if="inputController.checkboxes.length === 0">Geen {{ attribute.translation }} gevonden. Voeg eerst één toe. </p>

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






</style>

<script type="text/javascript">

	import ModelCheckboxController from '../../../app/inputController/modelCheckboxController';

	export default {
		props: {
			attributeName: null,
			attribute: null,
			value: "",
		},

		data() {
			return {
				inputController: null,
			}
		},

		beforeMount() {
			this.inputController = new ModelCheckboxController(this.attributeName, this.attribute, this.value);
		
		},

		mounted() {
			// user.find(window.user_id).then(() => {

			// });


			// User.find(2).roles().where(['name', '=', 'admin'])->get();

		},

		methods: {
	

		}
	}
</script>