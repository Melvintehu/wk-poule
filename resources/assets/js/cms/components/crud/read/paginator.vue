<template>
   <div v-if="paginator !== null">
        <div class="full-width">
            <div class="inline-block left">
                <ul class="pagination">
                    <li class="page-item" @click="paginator.previousPage()"><a class="text-color-dark" href="#">Vorige</a></li>
                    <li class="page-item" @click="paginator.changePageNumber(n)" v-for="n in paginator.maximumPages"><a class="text-color-dark" :class="{ 'text-color-main': n === paginator.currentPage }" href="#">{{ n }}</a></li>
                    <li class="page-item" @click="paginator.nextPage()"><a class="text-color-dark" href="#">Volgende</a></li>
                </ul>
            </div>
            <div class="inline-block right space-inside-up-sm">
                <span class="space-outside-sides-xs">Items per pagina:</span>
                <select v-model="paginator.itemsPerPage" class="border-curved space-inside-sides-sm space-inside-xs" @change="paginator.changeItemsPerPage()">
                    <option>10</option>
                    <option>20</option>
                    <option>50</option>
                    <option>100</option>
                </select>
            </div>
        </div>
   </div>
</template>

<script>
    import Paginator from '../../../app/Paginator/Paginator';

   export default {
       props: {
           referenceData: null,
       },

       data() {
           return {
               paginator: new Paginator(this.referenceData),
           }
       },

   }   
</script>

