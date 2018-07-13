@extends('master')

@section('content')
  
    <div class="bg-main padding-lg">
        <div class="container overflow-hidden padding-sides-sm">
            <div class="row ">
                <div class="col-xs-12 text-center padding-md">
                    <p class="text-secondary font-md bold">Positie {{ $position[0] }} / {{ $position[1] }} </p>
                    <h1 class="text-light font-lg bold">{{ Auth::user()->first_name }}</h1>
                </div>
                
            </div>
        </div>
    </div>

    <div class="container padding-sides-sm">
        <div class="row">
            <div class="col-xs-12 text-center padding-md">
                <h1 class="bold uppercase text-secondary font-md">TOTO Stand</h1>
                <p class="padding-xs font-xs light ">Regels voor puntentelling onderaan de pagina.</p>
            </div>
        </div>
    </div>

    <div class="container padding-sides-sm bg-accent padding-up-sm padding-down-sm margin-down-sm shadow-xs">
        <div class="row">
            <div class="col-xs-12 border-bottom border-accent margin-down-sm bg-main padding-xs">
                <div class="row">
                    <div class="col-xs-4 bold uppercase text-light"> 
                        <span style="width: 18px; height: 18px;" class=" text-light text-center font-xs inline-block bold uppercase margin-right-xs"> # </span>
                        Naam 
                    </div>
                    <div class="col-xs-2 bold uppercase text-center text-light"> P </div>
                    <div class="col-xs-1 bold uppercase text-center text-light"> C </div>
                    <div class="col-xs-1 bold uppercase text-center text-light"> R </div>
                    <div class="col-xs-1 bold uppercase text-center text-light"> T </div>
                    <div class="col-xs-1 bold uppercase text-center text-light"> G </div>
                    <div class="col-xs-1 bold uppercase text-center text-light"> T </div>
                    <div class="col-xs-1 bold uppercase text-center text-light"> S </div>
                </div>

            </div>
            @foreach($scores as $currentIteration => $score)          
                @if($loop->first)
                <div class="col-xs-12 margin-down-sm border-bottom border-main padding-down-sm">
                    <div class="row">
                        <div class="col-xs-4 bold uppercase font-xs"> 
                            <span style="width: 18px; height: 18px;" class="bg-secondary text-center font-xs inline-block text-light uppercase margin-right-xs"> {{ $score->position[0] }} </span>
                            {{ $score->user->first_name }} {{ substr($score->user->last_name, 0, 1) }} 
                        </div>
                        <div style="color: {{ $score->getColorCode() }}" class="col-xs-2 uppercase text-center bold"> {{ $score->score }} </div>
                        <div class="col-xs-1 uppercase text-center"> {{ $score->correct_match_outcomes }} </div>
                        <div class="col-xs-1 uppercase text-center"> {{ $score->correct_match_scores }} </div>
                        <div class="col-xs-1 uppercase text-center"> {{ $score->teams_to_next_round }} </div>
                        <div class="col-xs-1 uppercase text-center"> {{ $score->correct_team_with_most_goals }} </div>
                        <div class="col-xs-1 uppercase text-center"> {{ $score->correct_team_with_most_goals_against }} </div>
                        <div class="col-xs-1 uppercase text-center"> {{ $score->correct_top_scorer }} </div>
                    </div>
                    
                  
                </div>
                @else 
                <div class="col-xs-12 margin-down-xs">
                    <div class="row">
                        <div class="col-xs-4 bold uppercase font-xs"> 
                            <span style="width: 18px; height: 18px;" class="text-center font-xs inline-block border border-secondary uppercase margin-right-xs"> {{ $score->position[0] }} </span>
                            {{ $score->user->first_name }} {{ substr($score->user->last_name, 0, 1) }} 
                        </div>
                        <div style='color: {{ $score->getColorCode() }}' class="col-xs-2  text-center  bold"> {{ $score->score }} </div>
                        <div class="col-xs-1 uppercase text-center"> {{ $score->correct_match_outcomes }} </div>
                        <div class="col-xs-1 uppercase text-center"> {{ $score->correct_match_scores }} </div>
                        <div class="col-xs-1 uppercase text-center"> {{ $score->teams_to_next_round }} </div>
                        <div class="col-xs-1 uppercase text-center"> {{ $score->correct_team_with_most_goals }} </div>
                        <div class="col-xs-1 uppercase text-center"> {{ $score->correct_team_with_most_goals_against }} </div>
                        <div class="col-xs-1 uppercase text-center"> {{ $score->correct_top_scorer }} </div>
                    </div>
                </div>
                @endif
            @endforeach
            
        </div>
    </div>
    <div class="container padding-sides-sm">
        <div class="row">
            <div class="col-xs-12 text-center padding-up-md">
                <h1 class="bold uppercase text-secondary font-md">Puntentelling</h1>
            </div>

            <div class="col-xs-12 padding-md">
                <h2 class="margin-down-sm font-md uppercase bold"> Per ronde </h2>
                <p> - 3 punten per goed voorspelde toto (C)</p>
                <p> - 5 punten voor een correct uitslag (R)</p>
                <p class="margin-down-sm"> - 8 punten per correct voorspeld team in de eindklassering in de poulfase (T)</p>

                <h2 class="margin-down-sm font-md uppercase bold"> Eenmalig </h2>
                <p> - 20 punten voor correct voorspeld team met meeste doelpunten (G)</p>
                <p> - 20 punten voor correct voorspeld team met meeste tegendoelpunten (T)</p>
                <p> - 20 punten voor correct voorspelde topscoorder (S)</p>
            </div>
        </div>
    </div>
   
@endsection