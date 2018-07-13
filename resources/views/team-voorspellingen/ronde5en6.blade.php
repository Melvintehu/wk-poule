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
                    <h1 class="bold uppercase text-secondary font-md">Welke teams gaan door naar de troostfinale en finale?</h1>
                    <p>Zorg ervoor dat je niet tweemaal hetzelfde team invoert.</p>
                </div>

                <div class="col-xs-12 text-center padding-down-sm">
                    <p class="font-md font-md uppercase bold ">Troostfinale</p>
                </div>
                
                {{--  team 1  --}}
                <div class="col-xs-6 margin-sm text-center">
                    <p>Team 1</p>
                    <select class="border-none border-bottom border-secondary border-sm padding-sm paddings-sides-sm" name="team1" >
                        @foreach($comfortFinalTeams as $team)
                            <option value="{{ $team->id }}-t"> {{ $team->name }} </option>
                        @endforeach
                    </select>
                </div>

                {{--  team 2  --}}
                <div class="col-xs-6 margin-sm text-center">
                    <p>Team 2</p>
                    <select class="border-none border-bottom border-secondary border-sm padding-sm paddings-sides-sm" name="team2" >
                        @foreach($comfortFinalTeams as $team)
                            <option value="{{ $team->id }}-t"> {{ $team->name }} </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-xs-12 text-center border-top border-main padding-up-sm margin-up-sm">
                    <p class="font-md font-md uppercase bold ">Finale</p>
                </div>


                {{--  team 3  --}}
                <div class="col-xs-6 margin-sm text-center">
                    <p>Team 3</p>
                    <select class="border-none border-bottom border-secondary border-sm padding-sm paddings-sides-sm" name="team3" >
                        @foreach($comfortFinalTeams as $team)
                            <option value="{{ $team->id }}-f"> {{ $team->name }} </option>
                        @endforeach
                    </select>
                </div>

                {{--  team 4  --}}
                <div class="col-xs-6 margin-sm text-center">
                    <p>Team 4</p>
                    <select class="border-none border-bottom border-secondary border-sm padding-sm paddings-sides-sm" name="team4" >
                        @foreach($comfortFinalTeams as $team)
                            <option value="{{ $team->id }}-f"> {{ $team->name }} </option>
                        @endforeach
                    </select>
                </div>

               

                <div class="col-xs-12 margin-sm text-center">
                    <p class="margin-sm">Na het klikken op de onderstaande knop zijn je voorspellingen defintief.</p>
                    <button class="border-none font-xs shadow-xs bg-secondary uppercase text-light font-xs  text-center inline-block" style="padding-bottom: 10px; padding-top: 10px; width: 250px; border-radius: 50px;" >
                        Voorspelling invoeren
                    </button>
                </div>


            </div>
        </form>
    </div>
@endsection