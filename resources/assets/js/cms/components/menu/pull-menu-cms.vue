<template>
    <div style="position: relative;">
        <span @click="close()" v-if="isOpen == true" class=" text-light block text-uppercase space-outside-sm space-outside-sides-sm pointer" style="position: absolute; font-size: 20px; right: 30px; z-index: 101; height: 50px; width: 50px;">Sluiten</span>
        <div @click="open()" :class="{hover: isOpen}" class="pull-out-menu bg-secondary">

            <div class="title-pull-out-menu pointer">

                <slot name="pull-menu-title"></slot>
            </div>
            <ul class="nav-pull-out-menu pointer">
                <li>
                    <slot name="content"></slot>
                </li>
            </ul>
        </div>
    </div>
</template>

<style lang="scss" type="text/scss">
    @mixin vertical-align($position) {
        position:$position;
        top: 50%;
        -webkit-transform: translateY(-50%);
        -ms-transform: translateY(-50%);
        transform: translateY(-50%);
    }

    @mixin all-transition($time)
    {
        transition: all $time;
        -webkit-transition: all $time;
    }

    .pull-out-menu {

        font-weight: 100;
        background: #efefef;
        width: 450px;
        height: 100%;
        padding-left: 50px;
        position: fixed;
        z-index: 1;
        -webkit-box-shadow: -3px 0px 5px 0px rgba(0,0,0,0.2);
        box-shadow: -3px 0px 5px 0px rgba(0,0,0,0.2);
        right: -375px;
        @include all-transition(0.3s);
        color: #222;

        &.hover
        {
            transform: translate3d(-370px, 0, 0);
            animation-timing-function: 1s ease-in;
        }
        .title-pull-out-menu
        {
            top:50%;
            @include vertical-align(absolute);
            transform: rotate(270deg);
            left: -50px;
            font-weight: 800;
            font-size: 15px;

        }
        .nav-pull-out-menu
        {
            @include vertical-align(absolute);
            font-weight: 100;

            li
            {
                padding-bottom: 30px;
                list-style-type: none;
                width: 300px;
                a
                {
                    display: block;
                    text-decoration: none;
                    color: inherit;
                    @include all-transition(0.3s);

                    &:hover
                    {
                        color: #aaa;
                    }
                }
            }
        }
    }
</style>


<script type="text/javascript">
    export default {
        props: {

        },
        data() {
            return {
                isOpen: false,
            }
        },
        mounted() {

        },
        methods: {
            open() {
                this.isOpen = true;
            },

            close() {
                this.isOpen = !this.isOpen;
            }
        }
    }

</script>