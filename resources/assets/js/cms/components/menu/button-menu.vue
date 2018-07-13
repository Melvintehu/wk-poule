<template>
    <div style="width: 100%; position: relative;">
        <div @click="isOpen = !isOpen" class="bg-main bg-main-hover-darken-xs transition-normal text-color-light pointer"
             style="position: absolute; top: 10px; z-index: 10;">
            <i style="font-size: 31px;" class="material-icons space-inside-sides-sm space-inside-xs">menu</i>
        </div>

        <nav v-if="isOpen" class="bg-main animated fadeInDown text-thin"
                            style="position: absolute; top: 10px; left: 68px; z-index: 10; width: 70%;">
            <div class="text-color-light hidden-xs">
                <a style="width: 90px;" class="bg-main-hover-darken-xs space-inside-sm left transition-normal text-center xs-block xs-clear-floats" href="/">Home</a>
                <a style="width: 90px;" class="bg-main-hover-darken-xs space-inside-sm left transition-normal text-center xs-block xs-clear-floats" href="/artikelen">Artikelen</a>
                <a style="width: 90px;" class="bg-main-hover-darken-xs space-inside-sm left transition-normal text-center xs-block xs-clear-floats" href="/playlists">Playlists</a>
                <a style="width: 90px;" class="bg-main-hover-darken-xs space-inside-sm left transition-normal text-center xs-block xs-clear-floats" href="/contact">Contact</a>
            </div>
            <div style="width: 100%" class="text-color-light visible-xs">
                <a style="width: 100%" class="bg-main-hover-darken-xs space-inside-sm  transition-normal text-center xs-block xs-clear-floats" href="/">Home</a>
                <a style="width: 100%" class="bg-main-hover-darken-xs space-inside-sm  transition-normal text-center xs-block xs-clear-floats" href="/artikelen">Artikelen</a>
                <a style="width: 100%;" class="bg-main-hover-darken-xs space-inside-sm  transition-normal text-center xs-block xs-clear-floats" href="/playlists">Playlists</a>
                <a style="width: 100%;" class="bg-main-hover-darken-xs space-inside-sm  transition-normal text-center xs-block xs-clear-floats" href="/contact">Contact</a>
            </div>
        </nav>
    </div>
</template>
<script>
    export default{
        data(){
            return {
                isOpen: false,
            }
        }
    }
</script>