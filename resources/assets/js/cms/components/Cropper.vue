<template>
<div style="position: relative;" class="inline-block space-inside-right-sm">

    <div style="position: absolute" class=""></div>

    <div class="row">


    <div class="col-lg-12 reset-padding" style="text-align:center">
        <div class="" style="display: inline-block" v-if="photo != null"  >
            <img :id="getId()"  :src="getImage()">
        </div>
    </div>

    <div class="col-lg-12 reset-padding space-outside-sm" style="margin-bottom: 20px;" v-if="photo != null"  >
        
        <p  class="border-none outline-none bg-main shadow-xs inline-block text-color-light pointer space-inside-sm space-inside-sides-md" style="display: inline-block"  @click="storePhoto">Foto bijsnijden</p>
        
        <p style="display: inline-block; margin-top: 20px; margin-left: 20px;">
            <slot name="description"> </slot>
        </p>
        
    </div>


    <div v-if="croppedImage != null" class="col-lg-12">
        <p>Preview: </p>
    </div>
    <div class="col-lg-12 ">
        <div class="row">
            <div class="col-lg-12 thumb">
              <a class="thumbnail"   v-if="croppedImage != null">
                <img style="max-height:100%;" :src="getCroppedImage()">
              </a>
            </div>
        </div> 
    </div>



   
</div>


</div>
</template>

<script>
    export default {
        props: {
            dimension: "",
            dir: "",
            photo: "",
        },
        data() {
            return {
                image: null,
                croppedImage: null,
                cropper: null,
            }
        },
        created(){
    
            Event.listen('imageCropped' + this.getId(), (croppedImage) => {
                this.croppedImage = croppedImage;
            });
            Event.listen('croppingImage' + this.getId(), () => {
                this.croppedImage = null;
            });
            $(document).ready(() => {
                
                this.setCropper(this.photo);
            });
            Event.listen('overlay:closing', () => {
                this.storePhoto();
            });
        },
        methods: {
            /**
			 * Get the aspectwidth from the dimension.
			 */
			getAspectWidth(){
				return this.dimension.split("x")[0];
			},
			/**
			 * Get the aspectHeight from the dimension.
			 */
			getAspectHeight(){
				return this.dimension.split("x")[1];
			},
            getImage() {
                return '/images/'+ this.photo.type + '/' + this.photo.model_id + '/' + this.photo.filename + '?' + new Date().getTime();
            },
            getId() {
              
                return 'cropper' + this.getAspectWidth() + this.getAspectHeight() + this.photo.filename;
            },
            getCroppedImage() {
                return '/' + this.croppedImage + '?' + new Date().getTime();
            },
            setCropper() { 
                var image = document.getElementById(this.getId());
                console.log(image, "Cropper");
                this.cropper = new Cropper(image, {
                    aspectRatio: (this.getAspectWidth() / this.getAspectHeight()),
                });
                
            },
            storePhoto() {
                Event.fire('croppingImage' + this.getId());
                let containerData = this.cropper.getContainerData();
                let cropBoxData = this.cropper.getCropBoxData();
    
                let imageWidth = containerData.width;
                let imageHeight = containerData.height;
                let cropWidth = cropBoxData.width;
                let cropHeight = cropBoxData.height;
                let cropCoordinateLeft = cropBoxData.left;
                let cropCoordinateTop = cropBoxData.top;
                // calculate percentages
                let yPercentage  = ( Math.round( ( 100 / imageHeight ) * cropCoordinateTop ) / 100);
                let xPercentage = ( Math.round( (100 / imageWidth ) * cropCoordinateLeft ) / 100 );
                let cropHeightPercentage = Math.round( (100 / imageHeight ) * cropHeight ) / 100;
                let cropWidthPercentage = Math.round( ( 100 / imageWidth ) * cropWidth ) / 100;
                axios.get(
                    '/'+
                    'cropper' +
                    '?width='+ cropWidthPercentage +
                    '&height=' + cropHeightPercentage +
                    '&x=' + xPercentage +
                    '&y=' + yPercentage +
                    '&dir=' + this.dir +
                    '&photo=' + JSON.stringify(this.photo)
                , {}).then((response) => {
                    setTimeout(() => {
                        Event.fire('imageCropped' + this.getId(), response.data.croppedImage);
                        Notifier.success('Gelukt! De foto is succesvol bijgesneden');
                    });
                });
               
            },
        }
    }
</script>