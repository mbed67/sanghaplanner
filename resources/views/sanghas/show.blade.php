@extends('layouts.default')

@section('content')
    <div class="row">
        <div class="col-md-9">
            <div class="media">
                <div class="media-body">
                    <h1 class="media-heading">{{ $sangha->sanghaname }} </h1>
                </div>
            </div>
            <div>
                @include('users.partials.users', ['users' => $sangha->users])
            </div>
            <div>
            	@include('sanghas.partials.leave-sangha')
            </div>
        </div>
     	<div class="col-md-3">
            @if(Auth::user()->roleForSangha($sangha->id) == 'administrator')
	            <div class="membership-request">
	            	@include('notifications.partials.membershipRequests', ['notifications' => $notifications])
	            </div>
            @endif
    	</div>
    </div>

@stop
