<template>
    <div v-if="attribute !== null" class="col-lg-12 reset-padding " style="height: 100%;">

        <!-- The attribute field's title -->
        <p 
            style=" text-transform: capitalize" 
            class="
                font-sm text-bold text-color-dark 
                inline-block
                space-inside-up-xs space-inside-down-sm space-inside-right-sm 
                "
        >{{ attribute.translation }}</p>


        <!-- The WalkThrough for this input -->
        <div v-if="attribute.walkThrough !== undefined" class="inline-block">
            <tooltip :walkThrough="attribute.walkThrough"></tooltip>
        </div>

    </div>
</template>

<script>
    export default {
        props: {
            attribute: null,
        },
    }    
</script>