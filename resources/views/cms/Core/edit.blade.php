@extends('cms.master')

@section('content')
	<div class="col-lg-12 col-md-12 col-sm-12 space-inside-md bg-light shadow-xs space-outside-up-xl">
		<button class="
				bg-tertiary 
				space-inside-sides-md space-inside-sm 
				space-outside-sides-sm
				border-none
				text-color-light
				shadow-xs
				"    onclick="window.history.back()">Terug naar overzicht</button>
		<input-renderer-update id="{{$id}}"  type="{{$type}}" value="{{$object}}" identifier="update-{{$id}}"> </input-renderer-update>
	</div>
@endsection
