@extends('cms.master')

@section('content')
    
    @component('cms.base')
        @slot('icon')
            {{ $entity->icon }}
        @endslot
        @slot('title')
            {{ $entity->title }}
        @endslot

        @slot('type')
            {{ lcfirst($entity->name) }}
        @endslot

        @slot('description')
           {{ $entity->description }}
        @endslot
    @endcomponent
@endsection