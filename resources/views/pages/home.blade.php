@extends('layouts.default')

@section('content')
    <div class="jumbotron">
        <h1>Welkom bij de Sanghaplanner</h1>
        <p>Welkom bij de sanghaplanner. Je kunt je nu registreren</p>

        @if (! Auth::user())
            <p>
                {!! link_to('/auth/register', 'Aanmelden', ['class' => 'btn btn-lg btn-primary']) !!}
            </p>
        @endif

    </div>
@stop