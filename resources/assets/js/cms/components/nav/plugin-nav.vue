<template>
    <div >
       
        <!-- load a link to that plugin -->
        <a  @click="setActivePlugin(plugin)"  v-for="plugin in navLinks"
            href="#"
            class=" space-inside-sides-md space-inside-sm block bg-hover-main transition-fast outline-none text-color-secondary-darken-sm text-hover-light text-bold-hover text-bold font-sm  "> 

            <!-- icon -->
            <i  class="material-icons font-lg space-inside-right-sm">{{ plugin.icon }}</i>
            <span style="position: relative; bottom: 3px;"> {{ plugin.name }} </span>
        </a>

    </div>
</template>

<script>
    export default {
        props: {

        },

        data() {
            return {
                navLinks: [],
                roles: [],
                loading: true,
            }
        }, 

        mounted() {
            User.roles().then((roles) => {               
                for(let index in window.Plugins ) {
                    let plugin = new window.Plugins[index];
                    
                    if(User.hasRoles(roles, plugin.allowedRoles)) {
                        this.navLinks.push(plugin);
                    }
                }
            });
        },

        methods: {
            setActivePlugin(plugin){
                
                let pluginName =  JSON.stringify(plugin.constructor.name);
                localStorage.setItem('active-plugin', pluginName);
                setTimeout(() => {
                    window.location.href="/cms/plugin"
                }, 200);
            },

  
        }
    }    
</script>