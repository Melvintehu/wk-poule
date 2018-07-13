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
                <h1 class="bold uppercase text-secondary font-md">Overige voorspellingen</h1>
                <p class="light font-xs padding-xs padding-sides-sm margin-down-md"> Overzicht van overige voorspellingen. </p>
            </div>
        </div>
    </div>

    <div class="container padding-sides-sm padding-sm">
        <div class="row">
            <div class="col-lg-12">
                <p>
                    TS = Top scoorder
                </p>
                <p>
                    TMD = Team meeste doelpunten
                </p>
                <p>
                    TMTD = Team meeste tegendoelpunten
                </p>
            </div>
        </div>
    </div>

    <div class="container padding-sides-sm bg-accent padding-md">
        <div class="row">
            <div class="col-xs-12 margin-down-sm bg-main padding-xs text-light">
                <div class="row">
                    <div class="col-xs-3 bold">
                        <p>Naam</p>
                    </div>
                    <div class="col-xs-4 bold">TS</div>
                    <div class="col-xs-2 bold">TMD</div>
                    <div class="col-xs-3 bold">TMTD</div>
                </div>
            </div>

            @foreach($otherPredictions as $otherPrediction)
                <div class="col-xs-12">
                    <div class="row">
                        <div class="col-xs-3 bold font-xs">
                            <p> {{ $otherPrediction->user->first_name }} </p>
                        </div>
                        <div class="col-xs-4 font-xs">{{ $otherPrediction->top_scorer }}</div>
                        <div class="col-xs-2 font-xs">{{ $otherPrediction->tmd->name }}</div>
                        <div class="col-xs-3 font-xs">{{ $otherPrediction->tmtd->name }}</div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection