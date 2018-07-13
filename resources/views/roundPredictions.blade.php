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

    <div class="container">
        <div class="row">
            <div class="col-xs-12 text-center padding-up-md">
                <h1 class="bold uppercase text-secondary font-md">Voorspellingen voor de {{ $currentRound['name'] }}</h1>
                <p class="light font-xs padding-xs padding-sides-sm">Wat hebben anderen voorspeld voor de volgende ronde? Bekijk het hieronder.  </p>
            </div>
        </div>
    </div>


    <div class="container padding-md padding-sides-sm">
        <div class="row">
            @foreach($users as $user)
                <div class="col-xs-12 margin-down-sm text-center">
                    
                    <p class="padding-xs padding-sides-sm text-center block bg-main text-light bold margin-down-sm"> {{ $user->first_name }} {{ $user->last_name }} </p>
                    @foreach($user->teamPredictions as $teamPrediction)
                        @if($teamPrediction->eliminted)
                            <span style="background: rgb(255, 0, 0)" class="text-light border-curved margin-sides-xs margin-xs padding-xs padding-sides-sm inline-block shadow-xs"> {{ $teamPrediction->team->name }} </span>
                        @else
                            <span class="margin-sides-xs margin-xs bg-accent padding-xs border-curved padding-sides-sm inline-block shadow-xs"> {{ $teamPrediction->team->name }} </span>
                        @endif
                    @endforeach
                    
                </div>
            @endforeach
        </div>
    </div>

    

    
@endsection