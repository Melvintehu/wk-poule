<template>
    <div  class="col-lg-12 border-bottom border-secondary  space-inside-left-md bg-secondary-hover-darken-xs">
        <div class="row space-inside-sm">

            <!-- Icon -->
            <div class="col-lg-3">
                <img style="width: 20px; position: relative; top: 10px;" :src="'/images/fixed/' + icons[dossier.extension]" />
            </div>

            <!-- Filename -->
            <div  class="col-lg-3">
                <span style="position: relative; top: 10px;">
                    {{ dossier.filename}}
                </span>
            </div>       

            <!-- Date uploaded -->
            <div class="col-lg-3">
                <span style="position: relative; top: 10px;">
                    {{ dossier.created_at }}
                </span>
            </div>  

            <!-- File operations -->
            <div v-if="dossier !== null" class="col-lg-3">

                <!-- download button -->
                    <a title="Download dit bestand naar uw computer." v-if="canDownload" download :href="path">
                        <div   class="pointer space-inside-xs space-inside-sides-xs bg-secondary inline-block bg-hover-tertiary text-hover-light">
                            <i style="position: relative; top: 2px;" class="material-icons">file_download</i>
                        </div>
                    </a>
               

                <!-- delete button -->
                <div title="Verwijder dit bestand van de server." v-if="canDelete" @click="remove()" class="pointer space-inside-xs space-inside-sides-xs bg-secondary inline-block bg-hover-tertiary text-hover-light">
                    <i style="position: relative; top: 2px;" class="material-icons">delete</i>
                </div>

            </div>       
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            dossier: "",
            // permissions
            canDelete: false,
            canDownload: false,
        },

        data() {
            return {
                path: "",
                icons: {
                    txt: 'doc.png',
                    doc: 'doc.png',
                    docx: 'doc.png',
                    pdf: 'pdf.png',
                    ppt: 'ppt.png',
                    xlsx: 'xls.png',
                    xls: 'xls.png',
                    jpg: 'jpg.png',
                    JPG: 'jpg.png',
                    jpeg: 'jpg.png',
                    JPEG: 'jpg.png',
                    png: 'jpg.png',
                    PNG: 'jpg.png',
                    html: 'html.png',
                }
            }
        },  

        mounted() {
            this.download();
        },

        methods: {
            remove() {
                this.dossier.delete().then(() => {
                    Event.fire("dossier:deleted", this.dossier);
                });
            },

            download() {
                Dossier.find(this.dossier.id).then((dossier) => {
              
                    this.path = dossier.path;
                });
            }
        }
    }    
</script>