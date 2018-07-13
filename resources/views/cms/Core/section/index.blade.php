@extends('cms.master')

@section('content')
    @component('cms.base')
        @slot('icon')
           dashboard
        @endslot
        @slot('title')
            Secties
        @endslot

        @slot('type')
            section
        @endslot

        @slot('description')
            Beheer hier de verschillende pagina secties.
        @endslot
    @endcomponent
@endsection