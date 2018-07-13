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
                <h1 class="bold uppercase text-secondary font-md">Welk team krijgt de meeste tegendoelpunten ?</h1>
                <p>Je kan hiermee 20 punten verdienen. </p>
            </div>
        </div>
    </div>

    <div class="container padding-sides-sm">
        <form action="/mostGoalsAgainstTeam" method="POST" >
            @csrf
            @method('post')
            <div class="row">
            
                {{--  Naam  --}}
                <div class="col-xs-12 margin-up-sm text-center">
                    {{--  <div class="material-input">
                        <input name="mostGoalsAgainstTeam" type="text" class="bg-none outline-none text-main font-md " required>
                        <i class="material-icons icon text-main">label</i>
                        <div class="bottom-bar"></div>
                        <label class="font-md text-main">Naam van het team</label>
                    </div>  --}}
                     <select class="border-none border-bottom border-secondary border-sm padding-sm paddings-sides-sm" name="mostGoalsAgainstTeam" >
                        @foreach($teams as $team)
                            <option value="{{ $team->id }}"> {{ $team->name }} </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-xs-12 margin-up-md text-center">
                    <button class="border-none font-xs pointer outline-none shadow-xs bg-secondary uppercase text-light font-xs  text-center inline-block" style="padding-bottom: 10px; padding-top: 10px; width: 250px; border-radius: 50px;" >
                        Bevestigen
                    </button>
                </div>
                
            </div>
        </form>
    </div>

@endsection