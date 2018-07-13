<!-- Sidebar -->
<nav id="sidebar">
    

    <div class="padding-xs pointer padding-sides-xs margin-up-xs margin-sides-xs right visible-xs visible-sm">
    
        <i id="close" class="material-icons text-dark">close</i>
    </div>
    
    <div style="clear:both;"></div>
  
    <div class="col-xs-12 col-sm-12 padding-up-xs text-center margin-up-sm  reset-padding-sides" >
        <a href="/wedstrijd-overzicht" class="@if(Request::path() == 'wedstrijd-overzicht') bg-secondary border-bottom bold border-main text-light @endif padding-sm  text-left padding-left-lg block">Wedstrijdoverzicht </a>
        <a href="/voorspellingsoverzicht" class="@if(Request::path() == 'voorspellingsoverzicht') bg-secondary border-bottom bold border-main text-light @endif padding-sm  text-left padding-left-lg block">Voorspellingsoverzicht </a>
        <a href="/gespeelde-wedstrijden" class="@if(Request::path() == 'gespeelde-wedstrijden') bg-secondary border-bottom bold border-main text-light @endif padding-sm  text-left padding-left-lg block">Gespeelde wedstrijden </a>
        <a href="/stand" class="@if(Request::path() == 'stand') bg-secondary border-bottom bold border-main text-light @endif padding-sm  text-left padding-left-lg block">Stand </a>        
        <a href="/team-voorspellingen" class="@if(Request::path() == 'team-voorspellingen') bg-secondary border-bottom bold border-main text-light @endif padding-sm  text-left padding-left-lg block"> Volgende ronde voorspellen</a>       
        <a href="/overige" class="@if(Request::path() == 'overige') bg-secondary border-bottom bold border-main text-light @endif padding-sm  text-left padding-left-lg block"> Overige voorspellingen</a>       
        <a href="/ronde-voorspellingen" class="@if(Request::path() == 'ronde-voorspellingen') bg-secondary border-bottom bold border-main text-light @endif padding-sm  text-left padding-left-lg block"> Ronde voorspellingen</a>       
        {{--  <a href="/top-scoorder" class="@if(Request::path() == 'team-voorspellingen/ronde-5') bg-secondary text-light @endif padding-sm  text-left padding-left-lg block">Toernooi topscoorder voorspellen </a>  --}}
        {{--  <a href="/top-scoring-team" class="@if(Request::path() == 'team-voorspellingen/ronde-5') bg-secondary text-light @endif padding-sm  text-left padding-left-lg block">Team met meeste goals voorspellen </a>                  --}}
        {{--  <a href="/meeste-tegendoelpunten" class="@if(Request::path() == 'team-voorspellingen/ronde-5') bg-secondary text-light @endif padding-sm  text-left padding-left-lg block">Team met meeste tegen goals voorspellen </a>          --}}
    </div>
        
</nav>