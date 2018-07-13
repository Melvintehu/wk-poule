<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>CMS | MEN Technology & Media</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">
     
        <link rel="stylesheet" type="text/css" href="/CMS_CSS/css/app.css">
        
    </head>
    <body>
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
        <div id="app">

            <div class="hidden-xs col-lg-6 space-inside-right-xl full-height bg-secondary reset-padding" style="position: fixed;">

                
                <div class="text-right space-inside-lg">
                    <img class="animated fadeInLeft wow" style="max-width: 250px;" src="images/cms/logo.png" />
                </div>

                <div class="col-lg-8 float-right">
                    <h1 class="text-light text-right letter-spacing-xs" style="line-height: 55px;">
                        Welkom in het beheersysteem van uw website
                        <span class="bg-main inline-block" style="position: relative; bottom:5px; height: 15px; width: 15px;"></span>
                    </h1>
                </div>

                <div style="position: absolute; bottom: 0; right: 0;" class="space-inside-right-xl space-inside-down-lg">
                    <div class="space-inside-right-sm">
                        <p class="text-color-main text-bold text-right space-inside-down-sm">Aanbevolen browsers</p>

                        <p class="text-light">IE9, IE10, IE11, Chrome v59, FireFox v54, Edge, Safari 10.10</p>
                    </div>
                    
                </div>

            </div>

            <div class="hidden-xs col-lg-6 full-height bg-tertiary reset-padding" style="position: fixed; right: 0px;">

                <pull-menu-cms>
                    <h2 slot="pull-menu-title">Wachtwoord vergeten?</h2>
                    <forgot-password slot="content">

                        <div slot="CSRF">{{ csrf_field() }}</div>
                        <error error="{{ $errors->first('email')  }}"> </error>



                    </forgot-password>
                </pull-menu-cms>

                <div class="space-inside-up-xl space-inside-left-xl space-outside-up-xl space-inside-down-sm">
                    <h1 class="text-color-light">Login met uw gegevens</h1>
                </div>
                
                <form method="POST" action="{{ route('login') }}">
                 {{ csrf_field() }}
                    <div>
                        @if ($errors->has('email') || $errors->has('password'))
                            <div class="space-inside-left-xl">
                                <strong class="text-color-main">{{ $errors->first('email') }}</strong>
                            </div>
                        @endif
                        <span style="position: relative; top: 37px; left: 35px;"><i style="font-size:20px;" class="material-icons text-color-light">perm_identity</i></span>
                        <input type="email" class="
                        autofill-tertiary-lighten-xs autofill-color-light
                        outline-none 
                        space-inside-sm space-inside-left-xl
                        text-color-light  
                        bg-tertiary-lighten-xs 
                        full-width 
                        transition-normal 
                        border border-tertiary-lighten-xs border-bottom-main-focus border-xs" 
                        placeholder="voorbeeld@mentechmedia.nl" name="email" required/>

                    </div>
                    <div style="position: relative; bottom: 25px;">
                        <span style="position: relative; top: 37px; left: 35px;"><i style="font-size:20px;" class="material-icons text-color-light">lock_outline</i></span>
                        <input type="password" class="
                        autofill-tertiary-lighten-xs autofill-color-light
                        outline-none 
                        text-color-light
                        space-inside-sm space-inside-left-xl bg-tertiary-lighten-xs
                        full-width 
                        transition-normal
                        border border-tertiary-lighten-xs border-bottom-main-focus border-xs" name="password" required placeholder="******" />
                    </div>

                    <div>
                        <input type="submit" class="text-uppercase bg-main border-none border-main border-right border-top border-bottom text-color-light space-inside-sm space-inside-sides-xl" style="border-top-right-radius: 2em; border-bottom-right-radius: 2em;" value="inloggen">
                    </div>
                </form>

                <div style="position: absolute; bottom: 0; left: 0;" class="space-inside-left-xl space-inside-down-lg">
                    <div class="space-inside-left-sm">
                        <p class="text-color-main text-bold text-left space-inside-down-sm">Support</p>

                        <p class="text-light text-color-light">Problemen bij het inloggen? Mail naar <span class="text-color-main text-regular">informatie@mentechmedia.nl</span> of bel ons op <span class="text-color-main text-regular">0645532165</span> </p>
                    </div>
                    
                </div>
                
            </div>

            <div class="col-lg-12 visible-xs space-inside-sides-sm text-center space-outside-xl space-inside-xl"> 
                <h1>Mobiele apparaten worden op dit moment niet ondersteund. U kunt van de websitebeheertool gebruik maken op uw computer in de browser chrome. </h1>
            </div>

        </div>

        <script type="text/javascript" src="/js/app.js"></script>
    </body>
</html>
