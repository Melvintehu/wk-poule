<template>
    <div class="space-inside-sides-md" v-if="plugin !== null">
        <!-- The plugin icon -->
        <span class="inline-block " style="position: relative; bottom: 5px;">
            <i  class="material-icons text-color-dark font-xl space-inside-right-sm">{{ plugin.icon }} </i> 
        </span>

        <!-- the title of the component plugin -->
	    <h1 class="inline-block space-inside-right-md space-outside-down-sm text-color-dark text-bold text-uppercase letter-spacing-sm">{{ plugin.name }}</h1>

        <div style="clear:both;" class="space-inside-down-md"></div>

        <!-- Use a dynamic component to load the entry component of the plugin -->
        <component  :is="plugin.entryComponent"></component>
    </div>
</template>

<script>
    export default {
        props: {

        },

        data() {
            return {
                plugin: null,
            }
        }, 

        mounted() {
            this.plugin = this.loadPlugin(localStorage.getItem('active-plugin'));
        },

        methods: {
            loadPlugin(plugin) {
                plugin = JSON.parse(plugin);
                return new window.Plugins[Helper.lcfirst(plugin)];
            }
        }
    }    
</script>