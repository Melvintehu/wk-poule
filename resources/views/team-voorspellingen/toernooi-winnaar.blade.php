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
        <form action="/team-voorspellingen" method="POST">
            @csrf
            @method('post')


            <div class="row">
                <div class="col-xs-12 text-center padding-up-md padding-sides-md margin-down-md">
                    <h1 class="bold uppercase text-secondary font-md">Welk team wordt wereldkampioen?</h1>
                </div>

                {{--  team 1  --}}
                <div class="col-xs-12 margin-sm text-center">
                    <p>Team 1</p>
                    <select class="border-none border-bottom border-secondary border-sm padding-sm paddings-sides-sm" name="team1" >
                        @foreach($finalTeams as $team)
                            <option value="{{ $team->id }}"> {{ $team->name }} </option>
                        @endforeach
                    </select>
                </div>

               

            </div>

            <div class="row">
                <div class="col-xs-12 text-center padding-up-md padding-sides-md margin-down-md">
                    <h1 class="bold uppercase text-secondary font-md">Welk team wint de troostfinale?</h1>
                </div>

                {{--  team 1  --}}
                <div class="col-xs-12 margin-sm text-center">
                    <p>Team 2</p>
                    <select class="border-none border-bottom border-secondary border-sm padding-sm paddings-sides-sm" name="team2" >
                        @foreach($comfortFinalTeams as $team)
                            <option value="{{ $team->id }}"> {{ $team->name }} </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-xs-12 margin-sm text-center">
                    <p class="margin-sm">Na het klikken op de onderstaande knop is je voorspelling defintief.</p>
                    <button class="border-none font-xs shadow-xs bg-secondary uppercase text-light font-xs  text-center inline-block" style="padding-bottom: 10px; padding-top: 10px; width: 250px; border-radius: 50px;" >
                        Voorspelling invoeren
                    </button>
                </div>


            </div>
        </form>
    </div>
@endsection