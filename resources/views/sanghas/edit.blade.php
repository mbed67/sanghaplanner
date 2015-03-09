@extends('layouts.default')

@section('content')
<div class="row">
    <div class="col-md-6">
        <h1>Wijzig sanghagegevens</h1>

        @include('layouts.partials.errors')

        {!! Form::open(['route' => ['update_sangha_path', $sangha->id], 'files' => true]) !!}

            {!! Form::hidden('id', $sangha->id) !!}

            <!-- sanghaname form input -->
            <div class="form-group">
                {!! Form::label('sanghaname', 'Sanghanaam:') !!}
                {!! Form::text('sanghaname', e($sangha->sanghaname), ['class' => 'form-control', 'required']) !!}
            </div>

            <!-- Address form input -->
            <div class="form-group">
                {!! Form::label('address', 'Adres:') !!}
                {!! Form::text('address', e($sangha->address), ['class' => 'form-control', 'required']) !!}
            </div>

            <!-- Zip code form input -->
            <div class="form-group">
                {!! Form::label('zipcode', 'Postcode:') !!}
                {!! Form::text('zipcode', e($sangha->zipcode), ['class' => 'form-control', 'required']) !!}
            </div>

            <!-- Place form input -->
            <div class="form-group">
                {!! Form::label('place', 'Plaats:') !!}
                {!! Form::text('place', e($sangha->place), ['class' => 'form-control', 'required']) !!}
            </div>

            <!-- Filename form input -->
            <div class="form-group">
                {!! Form::label('image', 'Upload een foto:') !!}
                {!! Form::file('image') !!}
            </div>

            <!-- Submit button -->
            <div class="form-group">
            	{!! Form::submit('Wijzig sangha', ['class' => 'btn btn-primary']) !!}
            </div>
        {!! Form::close() !!}
    </div
</div>
@stop