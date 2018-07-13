<template>

	<div v-if="inputController !== null">
	
		<!-- Attribute title and walkThrough. -->
		<attribute-title :attribute="attribute"></attribute-title>

		<!-- Component for uploading images, it uses dropzone to handle the uploads. -->
		<image-uploader  :identifier='identifier' :type="type" ></image-uploader>

		<!-- A overlay to display the croppers after uploading a photo -->
		<overlay ask_confirm="true" confirm_message="Weet u zeker dat u de foto's zo op wilt slaan? "> 

			<div class="col-lg-12 reset-padding">
						
				<h1 class="text-color-dark text-left text-uppercase letter-spacing-sm text-bold">Foto's bijsnijden </h1>

				<p class="space-inside-sm text-color-accent font-md"> 
					U heeft zojuist een foto geuploaded. Om de foto geschikt voor de website te maken, moet u deze nog even op maat snijden. Dat doet u hieronder.				
				</p>

				<!-- Displays all the photos with their croppers -->
				<div>	

					<!-- Place a cropper on the photo for each dimension. -->
					<div v-if="inputController.photo !== null" :key="dimension" class="col-lg-6" v-for="(dimensionName, dimension) in attribute.dimensions">
						<cropper  :photo="inputController.photo" :dir="dimensionName" :dimension="dimension" > </cropper>
					</div>
					
				</div>

			</div>
		</overlay>
		
	</div>
</template>

<script type="text/javascript">
	import PhotoInputController from '../../../app/inputController/photoInputController';

	export default {
		props: {
			attribute: null,
			type: null,
			identifier: null,
		}, 
		data() {
			return {
				inputController: null,
			}
		},
		mounted() {
			this.inputController = new PhotoInputController(this.attribute);
		},
		
	}
</script>