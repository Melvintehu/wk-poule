<template>
<div style="min-height: 110px;">


	<!-- If no records were found in the database, we display a message that tells the user to add something. -->
	<transition name="fade"> 
		<div v-if="data !== undefined && !loading">
			
			<div v-if="data.length === 0" class="space-inside-sides-md space-outside-up-md text-center">
				<p style="border-width: 3px;" class="circle border-secondary border inline-block space-inside-xs space-inside-sides-sm text-color-dark text-bold">U heeft nog niks toegevoegd. </p>
			</div>
		</div>
	</transition>

	<!-- Loading spinner -->
	<loading v-if="loading"></loading>


	<transition name="fade">

		<div v-if="data.length !== 0" class="space-inside-sides-md space-outside-up-lg ">
			<div class="">

				<paginator :referenceData="referenceData"></paginator>
				
				<div class="col-lg-12 reset-padding space-outside-down-md">
					<input @keyup="filterData" placeholder="Typ in dit zoekvak om te zoeken in de onderstaande gegevens." class="
							border border-secondary border-curved-up outline-none
							space-inside-sides-md space-inside-sm 
							inline-block 
							full-width
							text-color-tertiary
							bg-secondary
							" />
				</div>
			
				<table v-if="data != null" class="table ">
					<tr>
						<th v-if="notHidden(attributeName)" v-for="(attributeValue, attributeName ) in object.fields" 
							class="
								bg-tertiary 
								text-color-light font-md 
								space-inside-sm space-inside-sides-sm 
								"
						>{{ (attributeValue.description !== undefined ) ? attributeValue.description : attributeValue.translation }}</th>

						<th class="
								bg-tertiary 
								text-color-light font-md 
								space-inside-sm space-inside-sides-sm 
								"> </th>

						<th class="
								bg-tertiary 
								text-color-light font-md 
								space-inside-sm space-inside-sides-sm 
								"> </th>
					</tr>

					<tr v-for="(row, key) in data" 
						class="
							space-inside-xs 
							border 
							bg-hover-secondary border-secondary 
							transition-normal 
							"
					>
						<!-- Attributes -->
						<td v-if="notHidden(attribute)"  
							class="space-inside-sm space-inside-sides-sm" 
							v-for="(value, attribute) in object.fields">
								<div v-if="modelHasAttribute(attribute)"> {{ needsToBeConverted(attribute, row) }} </div>

						</td>
						<!-- End of attributes -->


						<td style="width: 50px;" @click="remove(row)"
							class="space-inside-sm space-inside-sides-sm bg-danger pointer border-right border-secondary border-sm"> 
							<i style="position: relative; top: 2px;" class="material-icons text-color-light pointer">clear</i>
						</td>
						<td @click="edit(row)" style="width: 50px;" class="space-inside-sm space-inside-sides-sm bg-secondary pointer"> 
							<i   class="material-icons pointer text-color-tertiary">mode_edit</i> 
						</td>
					</tr>


				</table>
			</div>	
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
	import Search from '../../app/search/search';

	export default {
		props: {
			type: null
		},
		data() {
			return {
				object: Factory.getInstanceOf(this.type),
				data: [],
				referenceData: [],
				relatedModelData: {},
				loading: true,
			}
		},
		mounted() {
			
			setTimeout(() => {


				this.loadData();

				Event.listen(this.type + ':added', (newObject) => {
					
					this.data.push(newObject);
					this.referenceData = this.data;

					// this.referenceData.push(newObject);
				
				});


				Event.listen('paginator:changed', (paginatedData) => {
					this.data = paginatedData;
				});

			}, 500)
		},

		beforeMount() {
			let foundModel = Factory.getInstanceOf(this.type);
			let relatedModels = this.getRelatedModels(foundModel);
	
			_.each(relatedModels, (model) => {
				Factory.getStaticInstance(model).all().then((data) => {
					this.relatedModelData[model] = data;
				});
			});
			
		},

		methods: {

			/**
			* Filter by using a search function.
			 */
			filterData(event) {
				this.data = new Search().find(event.target.value, this.referenceData, this.object.fields);

				if(this.data.length === 0) {
					this.data = this.referenceData;
				} else {
					Event.fire('search:changed', this.data);
				}
				
			},

			getRelatedModels(model) {
				return _.filter(model.fields, (attribute, attributeName) => {
					return _.indexOf(['model'], attribute.type) !== -1 ;
				}).map((attribute) => {
					return attribute.model;
				});
			},

			needsToBeConverted(attribute, model) {
				let attributeRef = this.object.fields[attribute];

				if(attributeRef.referenceField === undefined) {
					return model[attribute];
				}

				return _.find(this.relatedModelData[attributeRef.model], (object) => {
					return object.id === model[attribute];
				})[attributeRef.referenceField];
			},

			notHidden(key) {
				if(this.object.fields[key] !== undefined) {
					if(this.object.fields[key].hidden !== undefined) {
						return this.object.fields[key].hidden.indexOf('read') === -1;
					}
				}

				return true;
			},
			
			loadData() {
				Factory.getStaticInstance(this.type).all().then((data) => {
					this.data = data;
				
					this.referenceData = data;
					this.loading = false;
				});
			}, 



			remove(object) {
				
				object = Factory.getInstanceOf(this.type, object);
				Notifier.askConfirmation('Weet u zeker dat u dit wilt verwijderen ?', () => {
					object.delete().then(() => {
						Event.fire(this.type + ':deleted', object);
						Notifier.success('Het verwijderen is gelukt!');
						
						for(let index in this.data) {
							let row = this.data[index];
							if(row.id === object.id) {
								this.data.splice(index, 1);
								this.referenceData.splice(index, 1);
								this.$forceUpdate();
							}
						}

	
					});
				});
			},

			edit(row) {
				window.location.href= '/cms/edit?type=' + this.type + '&id=' + row.id; 
			},

			presentPopover() {
				Event.fire('popover:present');
			},


			// ----------- BOOLEAN FUNCTIONS ----------- //
		

			modelHasAttribute(attribute) {
				return this.object.fields[attribute] !== undefined;
			},
		}
	}

</script>