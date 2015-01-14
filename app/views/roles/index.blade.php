@extends('layouts.default')

@section('content')
	<h1>Alle rollen</h1>
	@if ($roles->count())
	<div class="row">
        <div class="col-md-6">
        	<ul class="list-group">
        	    @foreach($roles as $role)
            	    <li class="list-group-item">{{ $role->rolename }}</li>
            	@endforeach
    	    </ul>
    @else
        Er zijn geen rollen
	@endif
	
    	<div class="form-group">
    	    {{ link_to_route('createrole_path', 'Maak een nieuwe rol aan', null, ['class' => 'btn btn-primary']) }}
    	</div>
	</div>
</div>
	
@stop