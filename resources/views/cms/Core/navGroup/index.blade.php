@extends('cms.master')

@section('content')
    @component('cms.base')
        @slot('icon')
           apps
        @endslot
        @slot('title')
            Navigatiegroep
        @endslot

        @slot('type')
            navGroup
        @endslot

        @slot('description')
            Beheer hier de navigatiegroepen.
        @endslot
    @endcomponent
@endsection