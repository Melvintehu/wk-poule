@extends('cms.master')

@section('content')
    @component('cms.base')
        @slot('icon')
           
        @endslot
        @slot('title')
            Entiteiten
        @endslot

        @slot('type')
            entity
        @endslot

        @slot('description')
            Beheer hier de verschillende entiteiten.
        @endslot
    @endcomponent
@endsection