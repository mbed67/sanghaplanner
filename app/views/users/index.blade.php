{{-- */$searchable = true;/* --}}

@extends('layouts.default')

@section('content')
    <h1>Alle leden</h1>
    
        <div>
            @foreach ($users as $user)
                <div class="col-md-3 user-block">
                    @include('users.partials.avatar', ['size' => 70])
                    <h4 class="user-block-username">
                    {{ link_to_route('profile_path', $user->firstname . " " . $user->middlename . " " . $user->lastname, $user->id) }}
                    </h4>
                </div>
            @endforeach
        </div>
    
@stop