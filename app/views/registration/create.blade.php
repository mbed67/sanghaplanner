@extends('layouts.default')

@section('content')
<div class="row">
    <div class="col-md-6">
        <h1>Aanmeldformulier</h1>
        
        @include('layouts.partials.errors')
        
        {{ Form::open(['route' => 'register_path']) }}
    
            <!-- Email form input -->
            <div class="form-group">
                {{ Form::label('email', 'Email:') }}
                {{ Form::text('email', null, ['class' => 'form-control', 'required']) }}
            </div>
            
            <!-- Password form input -->
            <div class="form-group">
                {{ Form::label('password', 'Wachtwoord:') }}
                {{ Form::password('password', ['class' => 'form-control', 'required']) }}
            </div>
            
            <!-- Password_confirmation form input -->
            <div class="form-group">
                {{ Form::label('password_confirmation', 'Nogmaals wachtwoord:') }}
                {{ Form::password('password_confirmation', ['class' => 'form-control', 'required']) }}
            </div>

            <!-- First name form input -->
            <div class="form-group">
                {{ Form::label('firstname', 'Voornaam:') }}
                {{ Form::text('firstname', null, ['class' => 'form-control', 'required']) }}
            </div>
            
            <!-- Middle name form input -->
            <div class="form-group">
                {{ Form::label('middlename', 'Tussenvoegsel:') }}
                {{ Form::text('middlename', null, ['class' => 'form-control']) }}
            </div>
            
            <!-- Last name form input -->
            <div class="form-group">
                {{ Form::label('lastname', 'Achternaam:') }}
                {{ Form::text('lastname', null, ['class' => 'form-control', 'required']) }}
            </div>
            
            <!-- Address form input -->
            <div class="form-group">
                {{ Form::label('address', 'Adres:') }}
                {{ Form::text('address', null, ['class' => 'form-control', 'required']) }}
            </div>
            
            <!-- Zip code form input -->
            <div class="form-group">
                {{ Form::label('zipcode', 'Postcode:') }}
                {{ Form::text('zipcode', null, ['class' => 'form-control', 'required']) }}
            </div>
            
            <!-- Place form input -->
            <div class="form-group">
                {{ Form::label('place', 'Woonplaats:') }}
                {{ Form::text('place', null, ['class' => 'form-control', 'required']) }}
            </div>
            
            <!-- Phone form input -->
            <div class="form-group">
                {{ Form::label('phone', 'Vaste telefoon:') }}
                {{ Form::text('phone', null, ['class' => 'form-control']) }}
            </div>
            
            <!-- GSM form input -->
            <div class="form-group">
                {{ Form::label('gsm', 'Mobiel nummer:') }}
                {{ Form::text('gsm', null, ['class' => 'form-control']) }}
            </div>
            
            <!-- Submit button -->
            <div class="form-group">
            	{{ Form::submit('Registreer', ['class' => 'btn btn-primary']) }}
            </div>
        {{ Form::close() }}
    </div
</div>   
@stop   