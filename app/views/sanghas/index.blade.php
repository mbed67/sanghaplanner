{{-- */$searchable = true;/* --}}

@extends('layouts.default')

@section('content')
	<h1>Alle sanghas</h1>
	@if ($sanghas->count())
	<div class="row">
        <div class="col-md-6">
        	<ul class="list-group">
            	@foreach($sanghas as $sangha)
            	    <li class="list-group-item">{{link_to("/sanghas/{$sangha->id}", $sangha->sanghaname) }}</li>
            	@endforeach
            </ul>
            @else
                Er zijn geen sangha's
        	@endif

        	<div class="form-group">
        	    {{ link_to_route('createsangha_path', 'Maak een nieuwe sangha aan', null, ['class' => 'btn btn-primary']) }}
        	</div>
	    </div>
	</div>
@stop