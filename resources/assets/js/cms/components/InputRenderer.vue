<template>
	<div >

		<!-- Loading spinner -->
		<loading v-if="!loaded"></loading>

		<div v-if="loaded" >	

			<!-- Title -->
			<div class="col-lg-7 col-md-7 reset-padding space-inside-md" >
				<h1 class="text-color-dark text-left text-uppercase letter-spacing-sm text-bold">Toevoegen</h1>
				<p class="space-inside-sm text-color-accent">
					<slot> 
						U kunt hier een nieuw item toevoegen.
					</slot>
				</p>
			</div>

			<!-- progressbar -->
			<div class="col-lg-5">
				<progressbar :progressBar="progressBar" :identifier='identifier' :totalInputs="totalInputs"> </progressbar>
			</div>


			<!-- Loop through all the attributes of a certain object -->

			<div v-for="(attribute, attributeName) in object.fields" class="col-lg-12 space-inside-xs ">
				<div class="row ">
				
					<!-- Each attribute has one input associated with it. You can find those inputs associations in every specific model. -->
					<div class="col-lg-12 reset-padding space-inside-left-xs">

						<!-- Dynamically load the associated model -->
						<component v-if="notHidden(attributeName)" :attributeName="attributeName" :attribute="attribute" :type="type"  :identifier="identifier" :is="'crud-' + attribute.type"></component>

					</div>

				</div>
			</div>

			<!-- Button for persisting the input data to the database -->
			<div class="row space-inside-sides-xs">
				<div class="col-lg-12 space-inside-sides-sm space-inside-up-sm">
					<button  @click="save()" class="border-none outline-none bg-main shadow-xs text-color-light space-inside-sm space-inside-sides-md">Toevoegen</button>
				</div>
			</div>

		</div>
	</div>
</template>

<script type="text/javascript" >
	import ProgressBar from '../app/ProgressBar/ProgressBar';

	export default {
		props: {
			object: null,
			type: null,
			identifier: null,
		},
		data() {
			return {
				totalInputs: Object.keys(this.object.fields).length,
				loaded: false,
				progressBar: null,
			}
		}, 
		mounted() {
			this.totalInputs = collect(this.object.fields).whereNotContains('hidden', 'create').count();
			
			this.progressBar = new ProgressBar(this.totalInputs);

			setTimeout(() => {
				this.loaded = true;
				this.progressBar.broadcastProgressBar();
			}, 700)

		},
		methods: {
			
			notHidden(key) {
				
				if(this.object.fields[key] !== undefined) {
					if(this.object.fields[key].hidden !== undefined) {
						return this.object.fields[key].hidden.indexOf('create') === -1;
					}
				}

				return true;
			},

			/**
			 * Save the data from the input to the database.
			 */
			save() {

				// Check inputs
				Event.fire('validator:validate');

				if(this.progressBar.isComplete()) {
					this.progressBar.reset();
					Event.fire('input:save'); // delegate the save logic to the underlying add component.
					Event.fire('inputs:clear');
					Notifier.success('Het toevoegen is gelukt!');
				}				
			},

		}
	}
</script>