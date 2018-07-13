<template>
	<transition-group name="fade"> 
		 <div :key="key" v-for="(error, key) in errors" v-if="Object.keys(errors).length > 0 " >

			 <i class="
			 		material-icons 
			 		inline-block 
			 		text-color-danger text-color-main 
			 		pointer 
			 		space-outside-sm space-inside-left-md space-inside-right-sm
			 		"
			 >warning</i>
			 
			 <p class="inline-block text-bold text-color-main space-outside-sm" style="position: relative; bottom: 6.5px;">{{ error }}</p>
		 </div>
	 </transition-group>
</template>

<style type="text/css">
	.fade-enter-active, .fade-leave-active {
	  transition: opacity .5s
	}
	.fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
	  opacity: 0
	}
</style>

<script type="text/javascript">
	export default {
		props: {
			errors: {},
		}
	}
</script>