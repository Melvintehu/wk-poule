<template>
<div class="row">
    <div v-if="progressBar !== null" class="col-lg-12 space-inside-up-lg  reset-padding">
        <div class="bg-secondary  reset-padding space-outside-down-sm border-curved">
            <div class="bg-main space-inside-sides-md space-inside-sm  border-curved width-over-time text-color-light"  :style="{width: progressBar.currentWidth + '%'}" >{{ progressBar.roundPercentage(progressBar.currentWidth) }}%</div>
        </div>
        
        <p class="float-right text-bold"> {{ progressBar.completedInputs }} / {{ progressBar.totalInputs }} velden correct ingevuld. </p>
    </div>  
</div>
</template>

<style type="text/css">
	.width-over-time {
		-webkit-transition: all .5s; /* Safari */
	    transition: all .5s;
	}
</style>

<script type="text/javascript">
    export default {
        props: {
            progressBar: null,
        },     
    }

</script>