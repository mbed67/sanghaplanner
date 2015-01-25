@extends('layouts.default')

@section('content')
	<h2>Meldingen voor {{ $user->firstname }} {{ $user->middlename }} {{ $user->lastname }}</h2>
	@if ($user->notifications->count())
	<div class="row">
        <div class="col-md-6">
			@foreach($user->notifications as $notification)
				<div class="list-group">
					@include('notifications.partials.notification')
				</div>
			@endforeach
	@else
		Er zijn geen meldingen
	@endif
	    </div>
	</div>
@stop