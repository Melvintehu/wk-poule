<template>
<div>
	<a
		class=" 
			space-inside-sides-md space-inside-sm 
			block
			bg-hover-main
			transition-fast 
			outline-none
			text-color-secondary-darken-sm text-hover-light text-bold-hover text-bold font-sm  "
	 	:href="'/cms/entity?type=' + id"> 

		<!-- icon -->
	 	<i  class="material-icons font-lg space-inside-right-sm">{{ icon }}</i>

		<span style="position: relative; bottom: 3px;"><slot></slot> </span>
	</a>

</div>
</template>

<script type="text/javascript">
	export default {
		props: {
			id: null,
			icon: null,
		}, 
		data(){
			return {
				url: this.getUrl(),
				innerId: this.setInnerId(this.id),
			}
		},

		mounted() {
			this.getUrl();
		},
		methods: {
			getUrl() {
				this.url = window.location.pathname.substring(1, window.location.pathname.length);
			},
			setInnerId(id) {

				if(id !== '') {
					return '/entity'; 
				}
				return '/entity';
			}
		}
	}
</script>