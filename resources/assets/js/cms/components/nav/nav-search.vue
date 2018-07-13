<template>
   <div @keyup="searchEntities" class="space-outside-left-md search-wrapper">
        <input v-model="searchValue" @blur="retract($event)" @click="expand()" :class="{ expanded: expanded }" type="text" 
                class="border-curved 
                    space-inside-sides-sm border-none 
                    space-inside-xs search-bar 
                    outline-none
                    transition-normal" 
        :placeholder="placeholderText">
        <transition name="fade">
            <span v-if="searchIconVisible" style="position: absolute; right: 8px; top: 7px;"><i class="material-icons" style='font-size: 20px;'>search</i></span>
        </transition>

        <div v-if="entities !== null" class="bg-light search-results full-width border-top border-secondary border-curved-down no-overflow">
            <a data-type="notCloseable" class="block 
                    space-inside-sides-sm space-inside-xs
                    border-bottom border-secondary
                    full-width
                    bg-hover-secondary transition-fast
                    text-hover-main
                    " :href="'/cms/entity?type=' + entity.name" v-for="entity in entities">{{ entity.name }}</a>
        </div>
    </div>
</template>
<style>
    .search-wrapper {
        position: relative;
    }

    .search-bar {
        width: 150px;
        position: relative;
        top: 4px;
    }
    
    .search-results {
        left: 0px;
        position: absolute;
    }

    .expanded {
        width: 300px;
    }

    .fade-enter-active, .fade-leave-active {
      transition: opacity .5s
    }

    .fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
      opacity: 0
    }

</style>
<script>
    import Search from '../../app/search/search';

   export default {

       data() {
           return {
               object: Factory.getInstanceOf('entity'),
                entities: null,
                referenceEntities: null,
                expanded: false,
                searchValue: '',
                placeholderText: '',
                searchIconVisible: true,
           }
       },

       beforeMount() {
           Factory.getStaticInstance('entity')
                .all()
                .then((entities) => {
                    this.referenceEntities = entities;
                });
       },

       mounted() {

       },

       methods: {
          searchEntities() {
            this.entities = new Search().find(this.searchValue, this.referenceEntities, this.object.fields);

            if(event.target.value === ''){
                this.entities = null;
            }
          },

          expand() {
              this.searchEntities();
              this.expanded = true;
              this.searchIconVisible = false;
              setTimeout(() => {
                this.placeholderText = "Zoek in CMS...";
              }, 300)
          },

          retract(event) {
              this.placeholderText = "";
              this.searchIconVisible = true;

              if(event.relatedTarget !== null && event.relatedTarget.attributes[0] !== undefined &&  event.relatedTarget.attributes[0].nodeValue === 'notCloseable'){
                event.preventDefault();
              }else{
                this.entities = null;
                this.expanded = false;
              }
          }
       }
   }   
</script>

