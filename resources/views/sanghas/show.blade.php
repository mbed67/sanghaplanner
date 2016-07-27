@extends('layouts.default')


@section('content')

    <div id="sangha-react"></div>

@stop

@include(
    'sanghas.partials.js',
    [
        'isAdminOfThisSangha' => $isAdminOfThisSangha,
        'isMemberOfThisSangha' => $isMemberOfThisSangha,
        'sangha' => $sangha,
        'notifications' => $notifications,
        'admins' => $admins,
        'members' => $members,
        'retreats' => $retreats
    ]
)
