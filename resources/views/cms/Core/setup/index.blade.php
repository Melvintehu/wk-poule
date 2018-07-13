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

            window.user_id = <?php echo json_encode(Auth::user()->id); ?>
        </script>
    </head>

    <body class="bg-secondary container space-inside-xl">
        <!-- top bar -->
        <div id="app"  >

            <div class="row">
                <div class="col-lg-12 space-outside-down-md"> 
                    <h1 class="text-color-tertiary"> Welkom, {{ Auth::user()->name }}. </h1>
                </div>
                <div class="col-lg-12">
                    <div class="bg-main space-inside-sides-md space-inside-md">
                        <p class="font-md text-color-light"> We gaan het CMS samen configureren. Dit doen we in een paar korte simpele stappen.</p>
                    </div>
                </div>
                

                <form action="cms/step1" method="POST">
                     {{ csrf_field() }}
                    <div class="col-lg-12 space-inside-md">
                        <p class="font-md space-outside-down-sm space-inside-left-md"> Stel eerst uw nieuwe wachtwoord in, u bent daarna de enige persoon met toegang tot dit account. </p>
                        <input 
                            name="password"
                            type="password"
                            placeholder="Nieuw wachtwoord"
                            class="border border-secondary border-curved outline-none
                                space-inside-sides-md space-inside-sm 
                                inline-block 
                                full-width
                                bg-light"  />
                    </div>

                    <div class="col-lg-12 space-inside-down-md">
                        <p class="font-md space-outside-down-sm space-inside-left-md"> Voer het wachtwoord nogmaals in ter bevestiging. </p>
                        <input 
                            name="password_confirm"
                            type="password"
                            placeholder="Bevestig wachtwoord"
                            class="border border-secondary border-curved outline-none
                                space-inside-sides-md space-inside-sm 
                                inline-block 
                                full-width
                                bg-light"  />
                    </div>

                    <div class="col-lg-12 space-inside-down-md">
                        <p class="font-md space-outside-down-sm space-inside-left-md"> Stel een profielfoto of avatar in. </p>
                        <setup></setup>
                    </div>

                    <div class="col-lg-12">
                        <button class="bg-tertiary space-inside-sm space-inside-sides-md text-color-light border-none outline-none"> Volgende stap - beheerdersrollen instellen</button>
                    </div>
                </form>
            </div>
        </div>
        <script type="text/javascript" src="/js/app.js"></script>
    </body>
</html>
