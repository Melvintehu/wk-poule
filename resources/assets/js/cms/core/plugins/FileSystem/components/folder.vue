<template>
    <div  class="  col-lg-2 col-md-2 col-sm-4 col-xs-6 space-outside-down-md">
        <div  class="bg-secondary transition-normal bg-secondary-hover-darken-xs square shadow-xs  pointer text-center">
            <i class="icon inline-block material-icons text-color-accent " style='font-size: 50px;'>folder</i>
            <span class="folder-name block full-width space-inside-sm" v-if="!inputVisible">{{ name }}</span>
            <input @blur="saveName" v-if="inputVisible" type="text" v-model="folderName" class="inputFolder border-none  space-inside-xs  bg-light text-color-tertiary" />
        </div>
    </div>
</template>

<style>
    .inputFolder {
        position: absolute;
        bottom: 10px;
        left: 0px;
        width: 100%;
        padding-left: 20px;
    }
 </style>

<script>
    export default {
        props: {
            name: "",
            id: "",
        },

        data() {
            return {
                inputVisible: false,
                folderName: "",
            }
        }, 

        mounted() {
            this.folderName = this.name;
            Event.listen("folder:display-input", (folder) => {
               
                if(this.id === folder.id) {
                    this.inputVisible = true;
                }
            });
        },

        methods: {
            saveName() {
                Folder.find(this.id).then((folder) => {
                    folder.name = this.folderName;
                    folder.update();
                    this.name = this.folderName;
                    this.inputVisible = false;
                }); 
            }
        }
    }    
</script>