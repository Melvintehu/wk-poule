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
        <meta id="token" name="csrf-token" value="{{ csrf_token() }}">
        <script>
    window.Laravel = <?php echo json_encode([
        'csrfToken' => csrf_token(),
    ]); ?>
</script>
    </head>
    <body class="bg-secondary container space-inside-xl">
        <!-- top bar -->
        <div id="app"  >
            <div class="row">
                
                <h1 class="text-color-main letter-spacing-xs">Een profielfoto instellen...</h1>
                <p style="line-height: 25px;" class="text-color-tertiary letter-spacing-xs space-inside-md">
                    Wij vinden het fijn dat we een gezicht hebben bij onze gebruikers. Hieronder kan u een foto van u zelf maken of uploaden.
                   
                </p>

                <div class="col-lg-7 reset-padding">
                    
                    <input class="
                            space-inside-sm space-inside-sides-md space-outside-down-md
                            border-curved border-none border-secondary outline-none
                            full-width
                           " 
                           type="text" 
                           name=""
                           placeholder="Telefoonnummer" 
                    >

                    </textarea>

                    <select class="
                            text-color-accent
                            space-inside-sm space-inside-sides-md space-outside-down-md
                            border-curved border-none border-secondary outline-none
                            full-width
                           " > 
                        <option>Wat voor cijfer geeft u uw ervaring met websitebeheertools?</option>
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                        <option>6</option>
                        <option>7</option>
                        <option>8</option>
                        <option>9</option>
                        <option>10</option>
                    </select>
                    <a class="font-xs text-thin left text-color-tertiary space-outside-md space-inside-sm" href="/cms/logout">Annuleren en uitloggen</a>
                    <div class="right">
                        <a href="/cms"  class="space-outside-md inline-block  border-none outline-none bg-tertiary shadow-xs text-color-light space-inside-sm space-inside-sides-md" style="display: inline-block"  @click="storePhoto">Vorige stap</a>

                        <p class="text-color-main inline-block space-inside-md space-inside-sides-md"> Opslaan en n aar het cms</p>

                        <a href="/cms?introduced=true"  class="space-outside-md inline-block  border-none outline-none bg-tertiary shadow-xs text-color-light space-inside-sm space-inside-sides-md" style="display: inline-block"  @click="storePhoto">Opslaan</a>
                    </div>
                </div>

            </div>
        </div>
        <script type="text/javascript" src="/js/app.js"></script>
    </body>
</html>
