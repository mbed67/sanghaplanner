@extends('layouts.default')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="media">
                <div class="pull-left">
                    @include('users.partials.avatar', ['size' => 50])
                </div>

                <div class="media-body">
                    <h1 class="media-heading">{{ $user->firstname }} {{ $user->middlename }} {{ $user->lastname }}</h1>
                </div>
            </div>
            <div>
                @include('sanghas.partials.sanghas', ['sanghas' => $user->sanghas])
            </div>
        </div>

    </div>

@stop