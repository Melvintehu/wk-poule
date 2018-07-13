<template>
    <div>
        <div class="col-lg-10 col-md-9 col-sm-8 col-xs-12 text-left" style="position: relative; bottom: 10px;">
            <a href="/jongeren" style="width: 35px; height: 35px; line-height: 35px;" class="space-outside-right-sm inline-block bg-secondary circle border-none text-color-light font-sm text-bold"><</a>
            <a href="/" class="text-color-tertiary text-bold"> Home <span class="space-inside-sides-sm"> > </span> </a>

            <div  v-for="(breadCrumb, index) in urlParts" class="inline" >

                <a  :href="getUrl(index)" class="text-color-tertiary text-bold"> 
               
                    <span class="text-color-dark capitalize" v-if="index === urlParts.length -1"> {{ breadCrumb}} </span> 
                    <span class="capitalize" v-if="index < urlParts.length -1" > {{ breadCrumb}} </span>
                    <span v-if="index < urlParts.length -1" class="space-inside-sides-sm"> > </span>
                </a>
            </div>
            
        </div>
    </div>
</template>

<style>
    .capitalize {
        text-transform: capitalize;
    }
</style>

<script>
    export default {
        props: {

        },

        data() {
            return {
                urlParts: "",
            }
        }, 

        beforeMount() {

            this.urlParts = this.stripHyphens(this.extractBreadCrumbs(window.location.href.split("/")));
            this.urlParts = this.urlParts.splice(2, this.urlParts.length);
            console.log(this.urlParts);
   
        },

        methods: {
            
            extractBreadCrumbs(urlParts) {
                let extract = [
                    "",
                ];

                
                return _.filter(urlParts, (urlPart) => {
                    return !_.includes(extract, urlPart);
                });
            },

            stripHyphens(breadCrumbs) {
                return _.map(breadCrumbs, (breadCrumb) => {
                    return breadCrumb.replace("-", " ");
                });
            },

            insertHyphens(breadCrumb) {
                return breadCrumb.replace(" ", "-");
            },


            getUrl(index) {
                let url = "";

                for(let i = 0; i <= this.urlParts.length-1; i++) {
                    console.log(this.urlParts[i]);
                    if(i <= index ) {
                        url += "/" + this.insertHyphens(this.urlParts[i]);
                    }
                }

                return url;
            }
        }
    }    
</script>