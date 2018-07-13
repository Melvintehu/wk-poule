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
            <div class="col-xs-12 text-center margin-md">
                <p class="bold uppercase text-main block">Je hebt de teams die doorgaan al opgegeven. </h1>
            </div>

            <div class="col-xs-12 text-center ">
                <a href="/wedstrijd-overzicht" class="shadow-xs  bg-secondary uppercase text-light font-xs  text-center inline-block" style="padding-bottom: 10px; padding-top: 10px; width: 250px; border-radius: 50px;" >
                   wedstrijd overzicht
                </a>
            </div>
        </div>
    </div>
@endsection