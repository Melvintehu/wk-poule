<template>
<div>
	<input @keyup="search()"
		   v-model="searchValue"
			  class="
                full-width
                space-inside-sm space-inside-sides-md 
                border-none outline-none 
                shadow-xs 

                " type="" placeholder="Wat wilt u beheren?" name="">

    <transition name="fade">

        <div v-if="hidden" class="col-lg-12  reset-padding bg-light space-inside-down-sm  shadow-xs font-md">
            <p class="space-inside-sm space-inside-sides-md border-secondary border-bottom text-color-accent ">Uw zoek resultaten</p>

            <p v-for="result in results" class="space-inside-sm pointer transition-fast bg-hover-main text-hover-light space-inside-sides-md">{{ result }}</p>
        </div>
    </transition>
</div>
</template>

<style >
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

		},
		data() {
			return {
				results: null,
				searchValue: "",
				hidden: false,
			}
		},
		mounted() {

		},
		methods: {
			search() {
				this.hidden = false;

				if(this.searchValue.length > 0) {
					this.hidden = true;
					this.results = [
						'nieuws',
						'facturen',
						'klanten',
						'projecten'
					];
				}
			}
		}
	}
</script>