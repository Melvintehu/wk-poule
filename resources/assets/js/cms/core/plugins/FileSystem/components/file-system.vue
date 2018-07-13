<template>
    <div >
        
        
        <!-- Loading spinner -->
	    <loading v-if="loading"></loading>
        <div  v-show="!loading">

            <!-- breadcrumbs -->
            <div class="col-lg-12  space-inside-down-md font-sm  space-outside-down-md"> 
                <div class="border border-accent-lighten-sm  space-inside-sides-sm block">
                    <span @click="toRoot()"  class="text-color-dark transition-normal  space-inside-sides-xs bg-hover-secondary pointer"> CLOUD DRIVE </span> <span v-if="breadCrumbs.length > 0" class="space-inside-sides-xs font-xs text-bold">> </span>
                   
                    <p @click="navigateTo(breadCrumb.id)" v-if="breadCrumbs.length !== 0" v-for="(breadCrumb, index) in breadCrumbs" class="inline-block">
                        <span  class="text-color-dark transition-normal  space-inside-sides-xs bg-hover-secondary pointer"> {{breadCrumb.name}} </span> <span v-if="index !== breadCrumbs.length-1" class="space-inside-sides-xs font-xs text-bold">> </span>
                    </p>
                   

                </div>
            </div>

            <!-- Operations -->
            <div class="col-lg-3 space-outside-down-lg">
                <div>

                    <!-- create a new folder -->
                    <div @click="folderCreateVisible = !folderCreateVisible;" title="Maak een nieuwe map aan" v-if="canAddDirectory" class="transition-normal border-curved bg-secondary operationButton bg-hover-main inline-block 
                    space-inside-sm space-inside-sides-sm  pointer">
                        <i class="material-icons text-color-accent">create_new_folder</i>
                    </div>

                    <!-- create a new file -->
                    <a v-if="canUpload" href="#uploadFile">
                        <div  title="Upload een bestand in deze map" class="transition-normal border-curved bg-secondary operationButton bg-hover-main inline-block 
                        space-inside-sm space-inside-sides-sm  pointer">
                            <i class="material-icons text-color-accent">file_upload</i>
                        </div>
                    </a>

                </div>
            </div>

            <!-- Folder create -->
            <transition name="fade">
                <div v-if="!folderCreateVisible && canAddDirectory" class="col-lg-12">

                    <!-- Label voor bij het tekstveld -->
                    <p class="space-outside-down-sm" >Voeg een map toe. Let op dat u een mapnaam kiest die nog niet bestaat in de huidige map.</p>
                    
                    <!-- Tekstveld voor het toevoegen van een mapnaam -->
                    <input type="text" v-model="folder.name" class="border-none space-inside-sm space-inside-sides-md bg-secondary" placeholder="Typ een unieke mapnaam binnen deze map" />
                    
                    <!-- Save button -->
                    <button @click="add()"  class="bg-tertiary border-none space-inside-sm space-inside-sides-sm text-color-light"> Toevoegen </button>

                </div>
            </transition>

            <!-- Directories -->
            <div class="col-lg-12">
                <div class="row space-inside-md">

                    <!-- Display all found folders -->
                    <div @contextmenu.prevent="showOptions($event, folder)" @dblclick="navigateTo(folder.id)" v-for="folder in rootFolders" :key="folder.id">
                        <folder :id="folder.id" :name="folder.name" ></folder>
                    </div>  

                    <div v-show="canDelete || canRename" >

                        <context-menu id="context-menu" ref="ctxMenu">
                            <div v-show="canRename"  @click="displayInput" class="pointer bg-hover-secondary full-width space-inside-sides-sm space-inside-xs border-bottom border-secondary font-md text-light">Naam wijzigen</div>
                            <div v-show="canDelete"  @click="remove()" class="pointer bg-hover-secondary full-width space-inside-sides-sm space-inside-xs border-bottom border-secondary font-md text-light">Verwijderen</div>
                        </context-menu>
                    </div>

                    <!-- Show a message to the user when there are no folders found.  -->
                    <div v-if="rootFolders.length === 0 && canAddDirectory" class="col-lg-12">
                        <p class="text-bold bg-secondary space-inside-sides-md space-inside-sm"> Er zijn geen mappen gevonden. Voeg één toe. </p>
                    </div>

                </div>
            </div>

            <!-- display all the files in the currentfolder -->

            <!-- Title -->
            <div class='col-lg-12 '> 
                <h1 class="inline-block space-inside-right-md space-outside-down-sm space-outside-up-lg text-color-dark text-bold text-uppercase letter-spacing-sm">Bestanden</h1>
            </div>

            <!-- Upload section for uploaden files -->

            <div  v-show="canUpload" id="uploadFile" class="col-lg-12 ">
           
                <form  action="/api/file-upload"
                class="dropzone"
                id="my-awesome-dropzone">
                <input name="folder_id" v-if="currentFolder !== null" type="hidden" v-model="currentFolder.id">
                <div class="dz-message" data-dz-message><span>Klik hier om een bestand te uploaden. U kan ook bestanden in dit vak slepen om ze te uploaden. </span></div>
                </form>
            </div>    

            <!-- display the files in this directory -->

            <div v-if="dossiers !== null" class="col-lg-12  space-inside-sides-md" style="margin-bottom: 200px">
                <div v-if="dossiers.length !== 0" class="row space-inside-sm bg-secondary">
                    <div class="col-lg-3">Bestandssoort</div>
                    <div class="col-lg-3">Naam</div>
                    <div class="col-lg-3">Toegevoegd op</div>
                </div>  

                <div v-if="dossiers.length !== 0" class="row border-top border-secondary " >
                    <div v-for="dossier in dossiers">
                    
                        <file :canDelete="canDelete" :canDownload="canDownload" :dossier="dossier"></file>

                    </div>
                </div>
                <p class="text-center space-inside-sides-md space-inside-sm text-bold" v-if="dossiers == null || dossiers.length === 0">Er zijn nog geen bestanden toegevoegd. </p>
            </div>

        </div>
    </div>
</template>

<style>

    .dropzone {
        border: 1px solid #F6F6F6  !important;
    }


    .ctx-menu {
        min-width: 250px;
        min-height: 100px;
        padding: 0px;
        margin: 0px;
        border-top: 5px solid #ce850b;
    }

    .square {
        position: relative;
    }

    .folder-name {
        position: absolute;
        bottom: 0px;
        left: 0px;
    }

    .operationButton {
        line-height: 10px;
    }

    .operationButton:hover > i{
        color: white !important;
    }

    .square:hover > .folder-name {
        background: #354052;
        color: white;
    }

    .fade-enter-active, .fade-leave-active {
      transition: opacity .5s
    }
    .fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
      opacity: 0
    }


</style>

<script>

    export default {
        props: {

        },

        data() {
            return {
                active: false,
                loading: true,
                root: null,
                showDownloadSection: false,
                showUploadSection: false,

                // folder creation variables
                folderCreateVisible: true,
                folder: new Folder,
                currentFolder: null,
                rootFolders: [],
                breadCrumbs: [],
                clickedFolder: null,
                dossiers: null,

                // permissions

                canDelete: false,
                canUpload: false,
                canAddDirectory: false,
                canDownload: false,
                canRename: false,
            }
        }, 

       created() {
           
       },

        mounted() {
            this.toRoot();

            User.isA(['admin', 'sitemanager']).then((isAuthenticated) => {
                this.canDelete = isAuthenticated;
                this.canUpload = isAuthenticated;
                this.canAddDirectory = isAuthenticated;
                this.canRename = isAuthenticated;
            });

            User.isA(['mentor', 'admin', 'sitemanager']).then((isAuthenticated) => {
                this.canDownload = isAuthenticated;
            });             


            Event.listen('load-files', () => {
                this.loadFiles();
            });

            Event.listen('dossier:deleted', (dossier) => {
                this.dossiers = collect(this.dossiers).where('id', '!==', dossier.id).all();
            });

            Dropzone.options.myAwesomeDropzone = {
                init: function() {
                    this.on("success", (file) => { 
                       Event.fire('load-files');
                       this.removeFile(file);
                    });
                },
                paramName: "file", // The name that will be used to transfer the file
                maxFilesize: 50, // MB
                accept: function(file, done) {
                    if (file.name == "justinbieber.jpg") {
                    done("Naha, you don't.");
                    }
                    else { 
                        done(); 

                    }
                }
            };

        },

        methods: {
            displayInput() {
                Event.fire('folder:display-input', this.clickedFolder);
            },

            showOptions(e, folder) {
                
                this.$refs.ctxMenu.open(e);
                this.clickedFolder = folder;
            },

            remove() {
                let parent_id = this.clickedFolder.parent_id;

                this.clickedFolder.delete().then(() => {
                    if(parent_id === null || parent_id === undefined) {
                        this.toRoot();
                    } else {
                        this.navigateTo(parent_id);
                    }
                });
            },


            add() {
                if(this.currentFolder !== null) {
                    this.folder.parent_id = this.currentFolder.id;
                }
                
                this.folder.save().then((createdFolder) => {
                    this.rootFolders.push(createdFolder);
                    this.updateDisplay();
                    this.folder.name = "";
                });
            },
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

            generateBreadCrumbs() {
                Folder.all().then((folders) => {
                    this.breadCrumbs = this.getParents(this.currentFolder, folders).all();
                });
            },

            getParents(folder, folders) {   
                if(!folder.hasParent()) {
                    return collect([folder]);
                }       

                return this.getParents(folder.parent(folders), folders).push(folder);
            },

            loadFiles() {
                if(this.currentFolder !== null) {
                    this.currentFolder.dossiers().then((dossiers) => {
                        this.dossiers = dossiers;
                    });
                } else {
                    Folder.rootDossiers().then((dossiers) => {
                        this.dossiers = dossiers;
                    });
                }
            },

            updateDisplay() {
                setTimeout(() => {
                    this.loadFiles();
                     

                    this.loading = false;
            
                    if(this.currentFolder !== null) {
                        this.generateBreadCrumbs();
                    }

                    $(document).ready(function() {
                        $(window).resize(function(){
                            // If there are multiple elements with the same class, "main"
                            $('.square').each(function() {
                                $(this).height($(this).width());
                            });

                            $(function() {
                                $('.icon').css({
                                    'position' : 'absolute',
                                    'left' : '50%',
                                    'top' : '50%',
                                    'margin-left' : -$('.icon').outerWidth()/2,
                                    'margin-top' : -$('.icon').outerHeight()/2
                                });
                            });


                        }).resize();
                    });
                    
                }, 50)
            }
        }
    }    
</script>