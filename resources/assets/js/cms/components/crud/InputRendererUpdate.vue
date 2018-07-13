<template>
<div class="bg-light space-inside-sides-sm">

    <!-- CONTENT HERE -->

    <!-- Loading spinner -->
    <loading v-if="!loaded"></loading>

    <div v-show="loaded">

        <!-- title -->
        <div class="col-lg-6 reset-padding space-inside-md" >
            <h1 class="text-color-dark text-left text-uppercase letter-spacing-sm text-bold">Aanpassen</h1>
            <p class="space-inside-sm text-color-accent">
                <slot> 
                pas hier dit item aan.
                </slot>
            </p>
        </div>

        <!-- progressbar -->
        <div class="col-lg-6">
            <transition name="fade">
                <progressbar :progressBar="progressBar" :identifier='identifier' :totalInputs="totalInputs"> </progressbar>
            </transition>
        </div>

        <!-- Inputs -->


        <!-- End of inputs -->
        <div v-if="object !== null && object !== undefined">
       
            <div  v-for="(attribute, attributeName) in object.fields" class="col-lg-12 space-inside-xs reset-padding">
                <component v-if="notHidden(attributeName)" :updateMode="true" :model_id="id" :attributeName="attributeName" :attribute="attribute" :type="type"  :value="innerValue" :identifier="identifier" :is="'crud-' + attribute.type"></component>           
            </div>

        </div>

        <div v-if="innerValue !== null && innerValue.original !== undefined && innerValue.original !== '' && innerValue.original !== null " 
            class="col-lg-4 space-outside-up-lg reset-padding bg-main">
                <p style="width: 100%; height: 100%;text-transform: capitalize" class="font-sm  text-bold inline-block  text-color-light  space-inside-sm space-inside-sides-sm ">De bijhorende foto</p>
                <img style="width: 100%;" :src="innerValue.original">
        </div>

        <!-- END OF CONTENT -->
        <div class="col-lg-12 space-inside-sides-xs space-inside-up-sm">
            <button  @click="update()" class=" inline-block border-none outline-none bg-main shadow-xs text-color-light space-inside-sm space-inside-sides-md">Aanpassen</button>
            <button class="
                    bg-tertiary 
                    space-inside-sides-md space-inside-sm 
                    space-outside-sides-sm
                    border-none
                    text-color-light
                    shadow-xs
                    "    onclick="window.history.back()">Terug naar overzicht</button>
        </div>
    
    </div>

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
    import ProgressBar from '../../app/ProgressBar/ProgressBar';

    export default {
        props: {
            value: null,
            type: null,
            identifier: null,
            id: null,
        },

        data() {
            return {
                object: null,
                hidden: true,
                totalInputs: 0,
                model_id: null,
                loaded: false,
                innerValue: null,

                progressBar: null,
            }
        }, 
        mounted() {
            this.innerValue = JSON.parse(this.value);
            this.object = Factory.getInstanceOf(this.type, { id: this.innerValue.id });
            this.totalInputs = collect(this.object.fields).whereNotContains('hidden', 'update').count();

            // init progress bar
            this.progressBar = new ProgressBar(this.totalInputs);
                
            this.progressBar.broadcastProgressBar();
            this.registerListeners();


            setTimeout(() => {
                Event.fire('input:insertValues');
            }, 200);

            setTimeout(() => {
                this.loaded = true;
             

              
            }, 500);
        },

        methods: {
            notHidden(key) {
				if(this.object.fields[key] !== undefined) {
					if(this.object.fields[key].hidden !== undefined) {
						return this.object.fields[key].hidden.indexOf('update') === -1;
					}
				}

				return true;
			},

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

            update() {
                this.object.id = this.innerValue.id;

                this.object.update().then((data) => {
                    Event.fire(this.type.toLowerCase() + ':updated');
                    Notifier.success('Het is gelukt! Aangepast')
                    Event.fire(this.type.toLowerCase() + ':added', this.object);
                });
            },
        }
    }
</script>