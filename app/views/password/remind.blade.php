@extends('layouts.default')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <h1>Vraag een nieuw wachtwoord aan.</h1>
            
            {{ Form::open() }}
                <!-- Email form input -->
                <div class="form-group">
                    {{ Form::label('email', 'Email:') }}
                    {{ Form::email('email', null, ['class' => 'form-control', 'required']) }}
                </div> 
                
                <div class="form-group">
                	{{ Form::submit('Nieuw wachtwoord aanvragen', ['class' => 'btn btn-primary']) }}
                </div>
            {{ Form::close() }}
        </div>
    </div>
@stop