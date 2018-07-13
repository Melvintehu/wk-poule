<template>
    <div >
        <select 
            @change="sorter.sort()"
            v-model="sorter.selectedSortType" 
            class="space-inside-xs space-inside-sides-sm outline-none border-curved border-secondary" v-if="sorter.initialized">
            <option disabled value="">Kies een optie.</option>
            <option class="space-inside-xs space-inside-sides-sm block" :value="key" v-for="(option, key) in sorter.options">{{key}}</option>
        </select>
    </div>
</template>

<script>
    import Sortable from '../../../app/Sortable/Sortable';

    export default {
        props: {
            object: null,
            data: null,
        },

        data() {
            return {
                sorter: new Sortable(this.data),
                loaded: false,
            }
        }, 

        mounted() {
            this.sorter.findSortableOptions(this.object);
        },
    }    
</script>