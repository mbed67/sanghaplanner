@extends('layouts.default')


@section('content')


    <div id="test-react"></div>

@stop

@include(
    'sanghas.partials.js',
    [
        'sangha' => $sangha,
        'notifications' => $notifications,
        'admins' => $admins,
        'retreats' => $retreats
    ]
)
