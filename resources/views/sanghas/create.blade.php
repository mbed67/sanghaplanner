@extends('layouts.default')

@section('content')
<div class="row">
    <div class="col-md-6">
        <h1>Maak een nieuwe sangha</h1>

        @include('layouts.partials.errors')

        {!! Form::open(['route' => 'createsangha_path', 'files' => true]) !!}

            <!-- sanghaname form input -->
            <div class="form-group">
                {!! Form::label('sanghaname', 'Sanghanaam:') !!}
                {!! Form::text('sanghaname', null, ['class' => 'form-control', 'required']) !!}
            </div>

            <!-- Address form input -->
            <div class="form-group">
                {!! Form::label('address', 'Adres:') !!}
                {!! Form::text('address', null, ['class' => 'form-control', 'required']) !!}
            </div>

            <!-- Zip code form input -->
            <div class="form-group">
                {!! Form::label('zipcode', 'Postcode:') !!}
                {!! Form::text('zipcode', null, ['class' => 'form-control', 'required']) !!}
            </div>

            <!-- Place form input -->
            <div class="form-group">
                {!! Form::label('place', 'Plaats:') !!}
                {!! Form::text('place', null, ['class' => 'form-control', 'required']) !!}
            </div>

            <!-- Filename form input -->
            <div class="form-group">
                {!! Form::label('image', 'Upload een foto:') !!}
                {!! Form::file('image') !!}
            </div>

            <!-- Submit button -->
            <div class="form-group">
            	{!! Form::submit('Maak sangha', ['class' => 'btn btn-primary']) !!}
            </div>
        {!! Form::close() !!}
    </div
</div>
@stop