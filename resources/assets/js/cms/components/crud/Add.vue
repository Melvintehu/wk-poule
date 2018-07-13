 <template>
 	<div>
 		<input-renderer :identifier="identifier" :type="type" :object="object"> 
 			<slot> </slot>
 		</input-renderer>
 	</div>
 </template>

 <script type="text/javascript">


 	require('../../Objects');

 	export default {

		props: {
			type: null,
		},

		data() {
			return {
				object: Factory.getInstanceOf(this.type),
				identifier: 'add',
			}
		},
		mounted() {
			this.registerListeners();

			Event.listen('input:save', () => {
				this.save();
			});

		}, 

		methods: {

			registerListeners() {

				let attributeExceptions = [
					'photo',
					'id',
				];


				Event.listen('input:updated', ({input, attributeName}) => {
                    if(!_.includes(attributeExceptions, attributeName)){
                        this.object[attributeName] = input;
                    } else {
                        Notifier.warning("Dit kan niet aangepast worden.");
                    }
                });



				_.each(this.object.fields, (attribute, attributeName) => {
					if(_.indexOf(attributeExceptions, attribute.type) === -1) {
						Event.listen('input:updated:' + attributeName, (value) => {
							this.object[attributeName] = value;
						});
					}
				});

			},

			save() {
				// delete this.object.fields
				this.object.save().then((object) => {
				
					Event.fire(this.type + ':added', object);
				});
			
			}
		}
 	}
 </script>