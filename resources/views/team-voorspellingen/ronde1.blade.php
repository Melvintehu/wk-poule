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
                    <h1 class="bold uppercase text-secondary font-md">Welke teams gaan door naar de achtste finales?</h1>
                    <p>Zorg ervoor dat je niet tweemaal hetzelfde team invoert.</p>
                </div>

                {{--  team 1  --}}
                <div class="col-xs-6 margin-sm text-center">
                    <p>Team 1</p>
                    <select class="border-none border-bottom border-secondary border-sm padding-sm paddings-sides-sm" name="team1" >
                        @foreach($teams as $team)
                            <option value="{{ $team->id }}"> {{ $team->name }} </option>
                        @endforeach
                    </select>
                </div>

                {{--  team 2  --}}
                <div class="col-xs-6 margin-sm text-center">
                    <p>Team 2</p>
                    <select class="border-none border-bottom border-secondary border-sm padding-sm paddings-sides-sm" name="team2" >
                        @foreach($teams as $team)
                            <option value="{{ $team->id }}"> {{ $team->name }} </option>
                        @endforeach
                    </select>
                </div>

                {{--  team 3  --}}
                <div class="col-xs-6 margin-sm text-center">
                    <p>Team 3</p>
                    <select class="border-none border-bottom border-secondary border-sm padding-sm paddings-sides-sm" name="team3" >
                        @foreach($teams as $team)
                            <option value="{{ $team->id }}"> {{ $team->name }} </option>
                        @endforeach
                    </select>
                </div>

                {{--  team 4  --}}
                <div class="col-xs-6 margin-sm text-center">
                    <p>Team 4</p>
                    <select class="border-none border-bottom border-secondary border-sm padding-sm paddings-sides-sm" name="team4" >
                        @foreach($teams as $team)
                            <option value="{{ $team->id }}"> {{ $team->name }} </option>
                        @endforeach
                    </select>
                </div>

                {{--  team 5  --}}
                <div class="col-xs-6 margin-sm text-center">
                    <p>Team 5</p>
                    <select class="border-none border-bottom border-secondary border-sm padding-sm paddings-sides-sm" name="team5" >
                        @foreach($teams as $team)
                            <option value="{{ $team->id }}"> {{ $team->name }} </option>
                        @endforeach
                    </select>
                </div>

                {{--  team 6  --}}
                <div class="col-xs-6 margin-sm text-center">
                    <p>Team 6</p>
                    <select class="border-none border-bottom border-secondary border-sm padding-sm paddings-sides-sm" name="team6" >
                        @foreach($teams as $team)
                            <option value="{{ $team->id }}"> {{ $team->name }} </option>
                        @endforeach
                    </select>
                </div>

                {{--  team 7  --}}
                <div class="col-xs-6 margin-sm text-center">
                    <p>Team 7</p>
                    <select class="border-none border-bottom border-secondary border-sm padding-sm paddings-sides-sm" name="team7" >
                        @foreach($teams as $team)
                            <option value="{{ $team->id }}"> {{ $team->name }} </option>
                        @endforeach
                    </select>
                </div>

                {{--  team 8  --}}
                <div class="col-xs-6 margin-sm text-center">
                    <p>Team 8</p>
                    <select class="border-none border-bottom border-secondary border-sm padding-sm paddings-sides-sm" name="team8" >
                        @foreach($teams as $team)
                            <option value="{{ $team->id }}"> {{ $team->name }} </option>
                        @endforeach
                    </select>
                </div>

                {{--  team 9  --}}
                <div class="col-xs-6 margin-sm text-center">
                    <p>Team 9</p>
                    <select class="border-none border-bottom border-secondary border-sm padding-sm paddings-sides-sm" name="team9" >
                        @foreach($teams as $team)
                            <option value="{{ $team->id }}"> {{ $team->name }} </option>
                        @endforeach
                    </select>
                </div>

                {{--  team 10  --}}
                <div class="col-xs-6 margin-sm text-center">
                    <p>Team 10</p>
                    <select class="border-none border-bottom border-secondary border-sm padding-sm paddings-sides-sm" name="team10" >
                        @foreach($teams as $team)
                            <option value="{{ $team->id }}"> {{ $team->name }} </option>
                        @endforeach
                    </select>
                </div>

                {{--  team 11  --}}
                <div class="col-xs-6 margin-sm text-center">
                    <p>Team 11</p>
                    <select class="border-none border-bottom border-secondary border-sm padding-sm paddings-sides-sm" name="team11" >
                        @foreach($teams as $team)
                            <option value="{{ $team->id }}"> {{ $team->name }} </option>
                        @endforeach
                    </select>
                </div>

                {{--  team 12  --}}
                <div class="col-xs-6 margin-sm text-center">
                    <p>Team 12</p>
                    <select class="border-none border-bottom border-secondary border-sm padding-sm paddings-sides-sm" name="team12" >
                        @foreach($teams as $team)
                            <option value="{{ $team->id }}"> {{ $team->name }} </option>
                        @endforeach
                    </select>
                </div>

                {{--  team 13  --}}
                <div class="col-xs-6 margin-sm text-center">
                    <p>Team 13</p>
                    <select class="border-none border-bottom border-secondary border-sm padding-sm paddings-sides-sm" name="team13" >
                        @foreach($teams as $team)
                            <option value="{{ $team->id }}"> {{ $team->name }} </option>
                        @endforeach
                    </select>
                </div>

                {{--  team 14  --}}
                <div class="col-xs-6 margin-sm text-center">
                    <p>Team 14</p>
                    <select class="border-none border-bottom border-secondary border-sm padding-sm paddings-sides-sm" name="team14" >
                        @foreach($teams as $team)
                            <option value="{{ $team->id }}"> {{ $team->name }} </option>
                        @endforeach
                    </select>
                </div>

                {{--  team 15  --}}
                <div class="col-xs-6 margin-sm text-center">
                    <p>Team 15</p>
                    <select class="border-none border-bottom border-secondary border-sm padding-sm paddings-sides-sm" name="team15" >
                        @foreach($teams as $team)
                            <option value="{{ $team->id }}"> {{ $team->name }} </option>
                        @endforeach
                    </select>
                </div>

                {{--  team 16  --}}
                <div class="col-xs-6 margin-sm text-center">
                    <p>Team 16</p>
                    <select class="border-none border-bottom border-secondary border-sm padding-sm paddings-sides-sm" name="team16" >
                        @foreach($teams as $team)
                            <option value="{{ $team->id }}"> {{ $team->name }} </option>
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