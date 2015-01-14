@extends('layouts.default')

@section('content')
    <div class="jumbotron">
        <h1>Welkom bij de Sanghaplanner</h1>
        <p>Welkom bij de sanghaplanner. Je kunt je nu registreren</p>

        @if (! $currentUser)
            <p>
                {{ link_to_route('register_path', 'Aanmelden', null, ['class' => 'btn btn-lg btn-primary']) }}
            </p>
        @endif
        
    </div>
@stop