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

    @if($match != null)

    <div class="container padding-sides-sm">
        <div class="row">
            <div class="col-xs-12 text-center padding-up-md">
                <h1 class="bold uppercase text-secondary font-md"> {{ $match->home_team }}  vs  {{ $match->away_team }}</h1>
                <p>Bekijk wat er voorspelt is door anderen. </p>
            </div>
            <div class="col-xs-6">
                <p  class="inline-block">Naam</p>
            </div>

            <div class="col-xs-3">
                <p  class="inline-block text-center"> <span style="width: 150px;">{{ $match->home_team }}</span> - </p>
            </div>

            <div class="col-xs-3">
                <p  class="inline-block text-center"> <span style="width: 150px;">{{ $match->away_team }}</span></p>
            </div>

            @foreach($predictions as $prediction)
            <div class="col-xs-6">
                <p class="inline-block">{{ $prediction->user->first_name }} {{ $prediction->user->last_name }}</p>
            </div>

            <div class="col-xs-3">
                <p  class="inline-block text-center"> <span style="width: 150px;">{{ $prediction->home_goals }}</span>  </p>
            </div> 

            <div class="col-xs-3">
                <p  class="inline-block text-center"><span style="width: 150px;">{{ $prediction->away_goals }}</span></p>
            </div> 
            @endforeach
        </div>
    </div>
    @else
    
    <div class="container">
        <div class="row">
            <div class="col-xs-12 text-center margin-up-md">
                <p> Er is op dit moment geen wedstrijd bezig. </p>
            </div>            
        </div>
    </div>
    @endif
@endsection