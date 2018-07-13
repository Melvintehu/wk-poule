<template>
    <div>
        <h2>Vul hier uw emailadres in.</h2>


        <form method="POST" action="password/email">
            <slot name="CSRF"></slot>

            <div>
                <span style="position: relative; top: 37px; left: 35px;"><i style="font-size:20px;" class="material-icons text-color-light">perm_identity</i></span>
                <input type="email" class="
                outline-none 
                space-inside-sm space-inside-left-xl
                text-color-light  
                bg-tertiary-lighten-xs 
                full-width 
                transition-normal 
                border border-tertiary-lighten-xs border-bottom-main-focus border-xs" 
                placeholder="voorbeeld@mentechmedia.nl" name="email" required/>
            </div>

            <div class="text-center">
                <button type="submit" class="text-uppercase bg-main border-none border-main text-color-light space-inside-sm space-inside-sides-xl space-outside-sm" style="border-radius: 2em;">stuur wachtwoord</button>
            </div>
        </form>
    </div>
</template>

<style lang="scss" type="text/scss">

</style>


<script type="text/javascript">
    export default {
        props: {

        },
        data() {
            return {

            }
        },
        mounted() {

        },
        methods: {

        }
    }

</script>