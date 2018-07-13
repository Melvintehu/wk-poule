<template>

    <div class="col-lg-12  space-inside-down-md font-sm  space-outside-down-md"> 
        <div class="border border-accent-lighten-sm  space-inside-sides-sm block">
            <span @click="toRoot()"  class="text-color-dark transition-normal  space-inside-sides-xs bg-hover-secondary pointer"> CLOUD DRIVE </span> <span v-if="breadCrumbs.length > 0" class="space-inside-sides-xs font-xs text-bold">> </span>
            
            <p @click="navigateTo(breadCrumb.id)" v-if="breadCrumbs.length !== 0" v-for="(breadCrumb, index) in breadCrumbs" class="inline-block">
                <span  class="text-color-dark transition-normal  space-inside-sides-xs bg-hover-secondary pointer"> {{breadCrumb.name}} </span> <span v-if="index !== breadCrumbs.length-1" class="space-inside-sides-xs font-xs text-bold">> </span>
            </p>
            

        </div>
    </div>

</template>

<script>
    export default {
        props: {

        },

        data() {
            return {

            }
        }, 

        mounted() {

        },

        methods: {

            toRoot() {
            
                
                Folder.rootFolders().then((folders) => {
                    this.rootFolders = folders;
                    this.currentFolder = null;
                    this.breadCrumbs = [];
                    this.updateDisplay();
                });
            },

            navigateTo(id) {
                
                Folder.find(id).then((folder) => {
                    
                    this.currentFolder = folder;

                    folder.children().then((folders) => {
                        this.rootFolders = folders;
                        this.updateDisplay();
                    })
                });
            },

            registerListeners() {

                Event.listen('toRoot', () => {
                    this.toRoot();
                });

                Event.listen('navigateTo', (id) => {
                    this.navigateTo(id);
                });

            },
        }
    }    
</script>