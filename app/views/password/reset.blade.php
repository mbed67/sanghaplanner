@extends('layouts.default')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <h1>Maak een nieuw wachtwoord aan.</h1>
            
            {{ Form::open() }}
                {{ Form::hidden('token', $token) }}
                
                <!-- Email form input -->
                <div class="form-group">
                    {{ Form::label('email', 'Email:') }}
                    {{ Form::email('email', null, ['class' => 'form-control', 'required']) }}
                </div>
                
                <!-- Password form input -->
                <div class="form-group">
                    {{ Form::label('password', 'Wachtwoord:') }}
                    {{ Form::password('password', ['class' => 'form-control', 'required']) }}
                </div> 
                
                <!-- Password confirmation form input -->
                <div class="form-group">
                    {{ Form::label('password_confirmation', 'Nogmaals wachtwoord:') }}
                    {{ Form::password('password_confirmation', ['class' => 'form-control', 'required']) }}
                </div> 
                
                <div class="form-group">
                	{{ Form::submit('Verzenden', ['class' => 'btn btn-primary']) }}
                </div>

            {{ Form::close() }}
        </div>
    </div>
@stop