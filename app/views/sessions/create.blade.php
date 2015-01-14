@extends('layouts.default')

@section('content')
    <h1>Inloggen</h1>

    <div class="row">
        <div class="col-md-6">
            {{ Form::open(['route' => 'login_path']) }}
                <!-- Email form input -->
                <div class="form-group">
                    {{ Form::label('email', 'Email:') }}
                    {{ Form::email('email', null, ['class' => 'form-control', 'required' => 'required']) }}
                </div>
                
                <!-- Password form input -->
                <div class="form-group">
                    {{ Form::label('password', 'Wachtwoord:') }}
                    {{ Form::password('password', ['class' => 'form-control', 'required' => 'required']) }}
                </div>
                
                <div class="form-group">
                	{{ Form::submit('Inloggen', ['class' => 'btn btn-primary']) }}
                	{{ link_to('password/remind', 'Wachtwoord vergeten') }}
                </div>
            
            {{ Form::close() }}
        </div>
    </div>
@stop