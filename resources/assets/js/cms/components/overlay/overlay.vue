<template>
<div>
	
	<transition name="fade">
	    <div v-show="hidden === false" style="position:fixed;top:0; left: 0;bottom: 0; right: 0; background: rgba(0,0,0,.7); z-index: 2000;">
	        
		    <div class="vertical-scrollbar"   style="z-index: 2000;width: 75%;
			    position: fixed;
			    top: 5%;
			    left: 55%;
			    max-height: 90%;
			    margin-left: -37.5%;  ">
			    <div    class="bg-light shadow-xs no-overflow col-lg-12 space-inside-sides-xl space-inside-lg" >
				    <span style="position: relative; z-index: 2500" class="right  block" @click="hide()">
				    	<i class="material-icons text-color-danger pointer">clear</i></span>
				    <slot> </slot>
			    </div>
			</div>
			
		</div>
	</transition>
</div>
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
			ask_confirm: "",
			confirm_message: "",
			identifier: null,
		},
		data() {
			return {
				hidden: true,
				hideCloseButton: false,
				
			}
		},
		
		mounted() {
			Event.listen('overlay:open', () => {
				
				this.show();
			});

			Event.listen('overlay:open' + this.identifier, () => {
				
				this.show();
			});

			Event.listen('overlay:close', () => {
				this.hide();
			});
			
		},
		
		methods: {
			show() {
                this.hidden = false;
                Event.fire('overlay:opening');
            },

            hide() {
            	if(this.ask_confirm === 'true') {
            		Notifier.askConfirmation(this.confirm_message, () => {
		                this.hidden = true;
		                Event.fire('overlay:closing');
            		});
            	} else {
            		this.hidden = true;
	                Event.fire('overlay:closing');
            	}
            },

          


		}
	}
</script>