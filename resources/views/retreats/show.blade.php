@extends('layouts.default')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="well">
                <h1>{{ $retreat->description }}</h1>
                <p>Begin: {{ $retreat->retreat_start->format('d-m-Y H:i') }}</p>
                <p>Eind: {{ $retreat->retreat_end->format('d-m-Y H:i') }}</p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            @include('retreats.partials.participants', ['participants' => $participants])

            @if(Auth::user()->roleForSangha($sanghaId) == 'administrator')
            <div class="form-group">
                 {!! link_to_route('sanghas.retreats.edit', 'Wijzig gegevens', [e($sanghaId), e($retreat->id)], ['class' => 'btn btn-primary']) !!}
            </div>
        	@endif

        </div>

        <div class="col-md-5">
            <div>
            </div>
        </div>
    </div>

@stop