<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title> @yield('title') Websites, Apps, Huisstijl | MEN Technology & Media</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,700" rel="stylesheet">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/flexboxgrid/6.3.1/flexboxgrid.min.css" type="text/css" >
    <link rel="stylesheet" media="screen and (max-width: 767px) " type="text/css" href="/flexbox/xs/app.css">
    <link rel="stylesheet" media="screen and (min-width:768px) and (max-width:991px)" type="text/css" href="/flexbox/sm/app.css">
    <link rel="stylesheet" media="screen and (min-width:992px) and (max-width:1199px)" type="text/css" href="/flexbox/md/app.css">
    <link rel="stylesheet" media="screen and (min-width:1200px)" type="text/css" href="/flexbox/lg/app.css">
    <?php 
        $id = null; 
        
        if(Auth::check()){ 
            $id = json_encode(Auth::user()->id); 
        } 
    ?>

    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>



     window.user_id =  <?php echo json_encode($id) ?>   
    </script>
</head>
<body>
    <div id="app">
        {{--  navigation  --}}
        

        <div class="">
            <div class="wrapper">

            @component('components.xs.navigation.sidebar') @endcomponent

                <!-- Page Content -->
                <div id="content" style="overflow: hidden;">
                    <div class="container-fluid reset-padding">
                    
                        <div style="padding-bottom: 10px;" class="bg-tertiary padding-left-sm padding-down-xs padding-up-sm">
                             @auth
                                <i id="sidebarCollapse" class="text-light material-icons ">
                                menu
                                </i>
                            
                                <a href="/cms/logout" class="right text-light padding-right-md">Afmelden</a>
                            @endauth

                            @guest
                                <div class="padding-xs"></div>
                            @endguest
                        </div>
                        
                        @yield('content')                        

                    </div>
                </div>
            </div>   
        </div>

        {{--  <div style="bottom: 0px; left: 0px; width: 100%;" class="absolute bg-secondary padding-sm"></div>  --}}
    </div>
    <script src="/js/app.js"></script>

    <script type="text/javascript">
             $(document).ready(function () {
                $('#sidebarCollapse').on('click', function () {
                     $('#sidebar').toggleClass('shadow-xs');
                     $('#sidebar').toggleClass('active');
                     if($('#sidebar').hasClass('active')){
                        $('body').addClass('no-scroll');
                        $('#app').addClass('no-scroll');
                     } else {
                        $('body').removeClass('no-scroll');
                        $('#app').removeClass('no-scroll');
                     }
                 });

                 $('#close').on('click', function () {
                     $('#sidebar').toggleClass('shadow-xs');
                     $('#sidebar').toggleClass('active');
                     if($('#sidebar').hasClass('active')){
                        $('body').addClass('no-scroll');
                        $('#app').addClass('no-scroll');
                        
                     } else {
                        $('body').removeClass('no-scroll');
                        $('body').removeClass('no-scroll');
                     }
                 });
             });
         </script>
</body>
</html>
