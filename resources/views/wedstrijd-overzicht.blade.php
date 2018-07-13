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
                <h1 class="bold uppercase text-secondary font-md">Wedstrijdoverzicht</h1>
                <p class="light font-xs padding-xs padding-sides-sm">Voor een goed voorspelde uitkomst verdien je 3 punten per wedstrijd, voor een correcte voorspelling van de score verdien je 5 punten per wedstrijd.  </p>
            </div>
        </div>
    </div>

    

    <wedstrijd-overzicht rawmatches="{{$matches}}" rawmatchdays="{{$matchdays}}"></wedstrijd-overzicht>
    
@endsection