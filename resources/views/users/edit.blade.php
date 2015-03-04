@extends('layouts.default')

@section('content')
<div class="row">
    <div class="col-md-6">
        <h1>Wijzig gegevens</h1>

        @include('layouts.partials.errors')

        {!! Form::open(['method' => 'PUT', 'route' => ['update_profile_path', $user->id]]) !!}

            {!! Form::hidden('id', $user->id) !!}

            <!-- Email form input -->
            <div class="form-group">
                {!! Form::label('email', 'Email:') !!}
                {!! Form::text('email', e($user->email), ['class' => 'form-control', 'required']) !!}
            </div>

            <!-- First name form input -->
            <div class="form-group">
                {!! Form::label('firstname', 'Voornaam:') !!}
                {!! Form::text('firstname', e($user->firstname), ['class' => 'form-control', 'required']) !!}
            </div>

            <!-- Middle name form input -->
            <div class="form-group">
                {!! Form::label('middlename', 'Tussenvoegsel:') !!}
                {!! Form::text('middlename', e($user->middlename), ['class' => 'form-control']) !!}
            </div>

            <!-- Last name form input -->
            <div class="form-group">
                {!! Form::label('lastname', 'Achternaam:') !!}
                {!! Form::text('lastname', e($user->lastname), ['class' => 'form-control', 'required']) !!}
            </div>

            <!-- Address form input -->
            <div class="form-group">
                {!! Form::label('address', 'Adres:') !!}
                {!! Form::text('address', e($user->address), ['class' => 'form-control', 'required']) !!}
            </div>

            <!-- Zip code form input -->
            <div class="form-group">
                {!! Form::label('zipcode', 'Postcode:') !!}
                {!! Form::text('zipcode', e($user->zipcode), ['class' => 'form-control', 'required']) !!}
            </div>

            <!-- Place form input -->
            <div class="form-group">
                {!! Form::label('place', 'Woonplaats:') !!}
                {!! Form::text('place', e($user->place), ['class' => 'form-control', 'required']) !!}
            </div>

            <!-- Phone form input -->
            <div class="form-group">
                {!! Form::label('phone', 'Vaste telefoon:') !!}
                {!! Form::text('phone', e($user->phone), ['class' => 'form-control']) !!}
            </div>

            <!-- GSM form input -->
            <div class="form-group">
                {!! Form::label('gsm', 'Mobiel nummer:') !!}
                {!! Form::text('gsm', e($user->gsm), ['class' => 'form-control']) !!}
            </div>

            <!-- Submit button -->
            <div class="form-group">
            	{!! Form::submit('Wijzig', ['class' => 'btn btn-primary']) !!}
            </div>
        {!! Form::close() !!}
    </div
</div>
@stop