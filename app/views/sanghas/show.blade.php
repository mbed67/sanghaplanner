@extends('layouts.default')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="media">
                <div class="media-body">
                    <h1 class="media-heading">{{ $sangha->sanghaname }}</h1>
                </div>
            </div>
            <div>
                @include('users.partials.users', ['users' => $sangha->users])
            </div>
            <div>
            	@include('sanghas.partials.join-sangha')
            </div>
        </div>
    </div>

@stop
