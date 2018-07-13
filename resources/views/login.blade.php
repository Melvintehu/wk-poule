@extends('master')

@section('content')
    {{--  {{ $errors }}  --}}
    <div class="bg-main padding-down-lg">
        <div class="container padding-up-md padding-down-lg overflow-hidden padding-sides-sm">
            <form method="post" action="/login">
                <div class="row padding-down-lg">
                    <div class="col-xs-12 text-center padding-md">
                        <p class="text-secondary font-md bold">2018</p>
                        <h1 class="text-light font-lg bold">WK POULE</h1>
                    </div>

                    @method('post')
                    @csrf

                    {{--  E-mailadres  --}}
                    <div class="col-xs-12 margin-up-sm ">
                        <div class="material-input">
                            <input name="email" type="email" class="bg-none outline-none text-accent font-md " required>
                            <i class="material-icons icon">label</i>
                            <div class="bottom-bar"></div>
                            <label class="font-md text-accent">E-mailadres</label>
                        </div>
                    </div>
                    
                  

                    {{--  Wachtwoord  --}}
                    <div class="col-xs-12 margin-up-sm margin-down-md">
                        <div class="material-input">
                            <input name="password" type="text" class="bg-none outline-none text-accent font-md " required>
                            <i class="material-icons icon">lock</i>
                            <div class="bottom-bar"></div>
                            <label class="font-md text-accent">Wachtwoord</label>
                        </div>
                    </div>

                    <div class="col-xs-12 text-center">
                        <button class="shadow-xs border-none bg-secondary uppercase text-light font-xs  text-center inline-block" style="padding-bottom: 10px; padding-top: 10px; width: 250px; border-radius: 50px;" href="#aanmelden">
                            Aanmelden
                        </button>
                    </div>

                    <div class="col-xs-12 text-center margin-up-md">
                        <a href="/register" class="text-light">
                            of maak hier een account
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
    
@endsection