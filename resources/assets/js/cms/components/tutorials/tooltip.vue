<template>
<div>

	<!-- The button that activates the walkThrough. -->
	<i @click="toggleWalkThrough()" style="position: relative; top: 8px;" class="pointer text-color-main inline-block material-icons">help_outline</i>

	<transition name="fade">
	<div v-if="started" class="test">
		<span class="
					shadow-xs
					text-color-light
					bg-main
					tooltiptext  
					space-inside-sides-md space-inside-md
					">

			<!-- Tooltip close button -->
			<span style="position: relative; z-index: 2500" class="right  block" @click="toggleWalkThrough(); walkThrough.reset()">
				    	<i class="material-icons text-color-danger pointer">clear</i></span>

			<!-- Displays the current step -->
			<p class="block text-color-tertiary"> Stap {{ walkThrough.currentStep+1 }} van {{ walkThrough.steps.length }} </p>


			<!-- Tooltip text -->
			<div v-if="walkThrough !== null && transition" class="space-inside-md">
				<p class="font-md text-color-light" v-text="walkThrough.current()"> </p>
			</div>		

			<!-- Tooltip navigation -->
			<div class="text-color-light">
				<button v-if="walkThrough.currentStep-1 >= 0 " @click="walkThrough.previous(); transitionWalkThrough()" class="bg-tertiary border-none space-inside-xs space-inside-sides-sm"> Vorige </button>
				<button v-if="walkThrough.currentStep+1 < walkThrough.steps.length " @click="walkThrough.next(); transitionWalkThrough()" class="bg-tertiary border-none space-inside-xs space-inside-sides-sm"> Volgende </button>
			</div>

		</span>
	</div>
	</transition>
</div>
</template>
<style type="text/css">
	.test {
		position: relative;
	    display: inline-block;
	  
	}

	.test .tooltiptext {
	    /* Position the tooltip */
	    min-width: 300px;
	    position: absolute;
			bottom: 20px;
			left: 0px;
	    z-index: 1;
	}

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
			walkThrough: null,
		},

		data() {
			return {
				started: false,
				transition: true,
			}
		},

		
		methods: {
			toggleWalkThrough() {
				this.started = !this.started;
			},

			transitionWalkThrough() {
				this.started = !this.started;

				setTimeout(() => {
					this.started = !this.started;
				}, 400); 
			}
		}
	}
</script>