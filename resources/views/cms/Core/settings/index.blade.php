@extends('cms.master')

@section('content')
    @component('cms.base')
        @slot('icon')
           settings
        @endslot
        @slot('title')
            Projectinstellingen
        @endslot

        @slot('type')
            settings
        @endslot

        @slot('description')
            Beheer hier de projectinstellingen.
        @endslot
    @endcomponent
@endsection