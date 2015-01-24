@extends('layouts.default')

@section('content')
	<h1>Meldingen voor {{ $user->firstname }} {{ $user->middlename }} {{ $user->lastname }}</h1>
	@if ($user->notifications->count())
	<div class="row">
        <div class="col-md-6">
			@foreach($user->notifications as $notification)
				<div class="notification {{ $notification->type }}">
					<p class="timestamp">{{ $notification->present()->timeWhenCreated() }}</p>
				    <p class="notification-body">{{ $notification->body }}</p>

			        @if($notification->type == "MembershipRequest" && $notification->hasValidObject())
			            <a href="/sanghas/{{ $notification->getObject()->id }}">Ga naar de sanghapagina</a>
			        @endif
				</div>
			@endforeach
	@else
		Er zijn geen meldingen
	@endif
	    </div>
	</div>
@stop