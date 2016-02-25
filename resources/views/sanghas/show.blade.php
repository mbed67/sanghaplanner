@extends('layouts.default')


@section('content')


    <div id="test-react"></div>

@stop

@include(
    'sanghas.partials.js',
    [
        'isAdminOfThisSangha' => $isAdminOfThisSangha,
        'isMemberOfThisSangha' => $isMemberOfThisSangha,
        'sangha' => $sangha,
        'notifications' => $notifications,
        'admins' => $admins,
        'retreats' => $retreats
    ]
)
