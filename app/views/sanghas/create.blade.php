@extends('layouts.default')

@section('content')
<div class="row">
    <div class="col-md-6">
        <h1>Maak een nieuwe sangha</h1>
        
        @include('layouts.partials.errors')
        
        {{ Form::open(['route' => 'createsangha_path']) }}
    
            <!-- Email form input -->
            <div class="form-group">
                {{ Form::label('sanghaname', 'Sanghanaam:') }}
                {{ Form::text('sanghaname', null, ['class' => 'form-control', 'required']) }}
            </div>
            
            <!-- Submit button -->
            <div class="form-group">
            	{{ Form::submit('Maak sangha', ['class' => 'btn btn-primary']) }}
            </div>
        {{ Form::close() }}
    </div
</div>   
@stop   