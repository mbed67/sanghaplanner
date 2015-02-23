@extends('layouts.default')

@section('content')
<div class="row">
    <div class="col-md-6">
        <h1>Maak een nieuwe rol</h1>

        @include('layouts.partials.errors')

        {!! Form::open(['route' => 'createrole_path']) !!}

            <!-- Email form input -->
            <div class="form-group">
                {!! Form::label('rolename', 'Rolnaam:') !!}
                {!! Form::text('rolename', null, ['class' => 'form-control', 'required']) !!}
            </div>

            <!-- Submit button -->
            <div class="form-group">
            	{!! Form::submit('Maak rol', ['class' => 'btn btn-primary']) !!}
            </div>
        {!! Form::close() !!}
    </div
</div>
@stop