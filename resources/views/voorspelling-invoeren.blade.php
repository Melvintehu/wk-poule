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
                <h1 class="bold uppercase text-secondary font-md">Voorspelling invoeren</h1>
            </div>
        </div>
    </div>

    {{--  individuele wedstrijd  --}}
    <div class="container">
        <div class="row">
            <div class="col-xs-12 text-center padding-up-md">
                <p> {{ $match->start_time }} {{ $match->end_time }} </p>
            </div>
        </div>
    </div>

    <div class="bg-accent text-center padding-sm margin-up-sm">
        <p class="inline-block padding-sides-md bold"> {{$match->home_team }} </p>
        <p class="inline-block padding-sides-md bold">vs</p>
        <p class="inline-block padding-sides-md bold"> {{ $match->away_team }} </p>
    </div>

    <div class="container padding-sides-sm">
        <form action="/voorspelling-bevestigen" method="POST" >
            @csrf
            @method('post')
            <div class="row">
                <input value="{{ $match->id }}" name="match_id" type="hidden" class="bg-none outline-none text-main font-md " required>                        

                {{--  Doelpunten thuis  --}}
                <div class="col-xs-6 margin-up-sm ">
                    <div class="material-input">
                        <input name="home_goals" type="number" class="bg-none outline-none text-main font-md " required>
                        <i class="material-icons icon text-main">label</i>
                        <div class="bottom-bar"></div>
                        <label class="font-md text-main">Doelpunten thuis</label>
                    </div>
                </div>

                {{--  Doelpunten uit  --}}
                <div class="col-xs-6 margin-up-sm ">
                    <div class="material-input">
                        <input name="away_goals" type="number" class="bg-none outline-none text-main font-md " required>
                        <i class="material-icons icon text-main">label</i>
                        <div class="bottom-bar"></div>
                        <label class="font-md text-main">Doelpunten uit</label>
                    </div>
                </div>

                <div class="col-xs-12 margin-up-md text-center">
                    <button href="#voorspelling-bevestigen" class="border-none font-xs pointer outline-none shadow-xs bg-tertiary uppercase text-light font-xs  text-center inline-block" style="padding-bottom: 10px; padding-top: 10px; width: 250px; border-radius: 50px;" >
                        Voorspelling invoeren
                    </button>
                </div>
            </div>
        </form>
    </div>


@endsection