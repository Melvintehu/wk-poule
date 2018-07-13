<template>
    <div style="position: relative; z-index: 16;">
        <span @click="close()" v-if="isOpen == true"
              class="text-light block text-uppercase space-outside-up-lg space-outside-sides-sm pointer animated slideInRight"
              style="position: fixed; font-size: 20px; right: 10px; z-index: 15000; height: 50px; width: 50px;"
        ><i class="material-icons text-hover-main transition-normal">close</i></span>

        <div @click="open()" :class="{hover: isOpen}" class="pull-out-menu bg-secondary space-inside-up-md">

            <div style="clear: both;"></div>

            <div class="nav-pull-out-menu xs-space-outside-up-lg text-center">
                <!-- Link -->
                <div class="block menu__link__container">

                    <div style="width: 50px;" class="left">
                        <span style="visibility: hidden; opacity: 0;" class="bg-main space-inside-xs space-inside-sides-xs inline-block menu__active__status"></span>
                    </div>

                    <a class="menu_link font-md text-hover-main left" href='/#top'>Home</a>


                </div>
                <!-- end of link -->

                <!-- Link -->
                <div class="block menu__link__container">
                    <div style="width: 50px;" class="left">
                        <span style="visibility: hidden; opacity: 0;" class="bg-main space-inside-xs space-inside-sides-xs inline-block menu__active__status"></span>
                    </div>

                    <a class="menu_link font-md text-hover-main left" href='/#portfolio'>Portfolio</a>

                </div>
                <!-- end of link -->

                <!-- Link -->
                <div class="block menu__link__container">
                    <div style="width: 50px;" class="left">
                        <span style="visibility: hidden; opacity: 0;" class="bg-main space-inside-xs space-inside-sides-xs inline-block menu__active__status"></span>
                    </div>

                    <a class="menu_link font-md text-hover-main left" href='/#over-ons'>Over ons</a>

                </div>
                <!-- end of link -->

                <!-- link -->
                <div class="block menu__link__container">
                    <div style="width: 50px;" class="left">
                        <span style="visibility: hidden; opacity: 0;" class="bg-main space-inside-xs space-inside-sides-xs inline-block menu__active__status"></span>
                    </div>

                    <a class="menu_link font-md text-hover-main left" href='/#diensten'>Diensten</a>

                </div>
                <!-- end of link -->

                <!-- link -->
                <div class="block menu__link__container">
                    <div style="width: 50px;" class="left">
                        <span style="visibility: hidden; opacity: 0;" class="bg-main space-inside-xs space-inside-sides-xs inline-block menu__active__status"></span>
                    </div>

                    <a class="menu_link font-md text-hover-main left" href='/#partners'>Partners</a>

                </div>
                <!-- end of link -->

                <!-- Link -->
                <div class="block menu__link__container">
                    <div style="width: 50px;" class="left">
                        <span style="visibility: hidden; opacity: 0;" class="bg-main space-inside-xs space-inside-sides-xs inline-block menu__active__status"></span>
                    </div>

                    <a class="menu_link font-md text-hover-main left" href='/#contact'>Contact</a>

                </div>
                <!-- end of link -->
            </div>

        </div>
    </div>
</template>
<style type="text\css">
    .fade-enter-active, .fade-leave-active {
        transition: opacity .5s ease-out;
    }

    .fade-enter, .fade-leave-to {
        opacity: 0;
    }
</style>
<style lang="scss" type="text/scss">
    @mixin vertical-align($position) {
        position:$position;
        top: 30%;
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
        width: 370px;
        height: 100%;
        padding-left: 50px;
        position: fixed;
        z-index: 1;
        -webkit-box-shadow: -3px 0px 5px 0px rgba(0,0,0,0.2);
        box-shadow: -3px 0px 5px 0px rgba(0,0,0,0.2);
        right: -370px;
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
                width: 100px;
                a
                {
                    font-weight: semi-bold;
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
            Event.listen('menu:open', () => {
                this.open();
        });

            $('.menu_link').on('click', () => {
                this.isOpen = false;
        });

            $(document).ready(() => {
                $('.menu__link__container').mouseenter(
                function() {
                    $(this).find('.menu__active__status').css({visibility: 'visible'}).animate({opacity: 1}, 1000);
                });

            $('.menu__link__container').mouseleave(function() {
                $(this).find('.menu__active__status').css({ visibility: 'hidden'}).animate({opacity: 0}, 1000);
            });
        });

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