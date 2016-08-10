@extends('layouts.default_js_in_header')

@section('content')
<div class="row">
    <div class="col-md-6">
        <h1>Maak een nieuw evenement</h1>

        @include('layouts.partials.errors')

        {!! Form::open(['route' => ['store_retreat_path', $sanghaId]]) !!}
           {!! Form::hidden('sanghaId', $sanghaId) !!}

            <!-- sanghaname form input -->
            <div class="form-group">
                {!! Form::label('description', 'Omschrijving:') !!}
                {!! Form::text('description', null, ['class' => 'form-control', 'required']) !!}
            </div>

            <div class="form-group">
                    {!! Form::label('retreat_start', 'Begin:') !!}
                    {!! Form::text('retreat_start', null, ['maxlength' => 25, 'size' => 25]) !!}
                    <img src="/images/images2/cal.gif" onclick="javascript:NewCssCal('retreat_start','ddMMyyyy','dropdown',true,'24')" style="cursor:pointer"/>
             </div>

            <div class="form-group">
                {!! Form::label('retreat_end', 'Einde:') !!}
                    {!! Form::text('retreat_end', null, ['maxlength' => 25, 'size' => 25]) !!}
                    <img src="/images/images2/cal.gif" onclick="javascript:NewCssCal('retreat_end','ddMMyyyy','dropdown',true,'24')" style="cursor:pointer"/>
            </div>

            <!-- Submit button -->
            <div class="form-group">
            	{!! Form::submit('Maak evenement', ['class' => 'btn btn-primary']) !!}
            </div>
        {!! Form::close() !!}
    </div
</div>
@stop
