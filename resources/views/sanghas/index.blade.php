{{-- */$searchable = true;/* --}}

@extends('layouts.default')

@section('content')
	<div class="row">
        <div class="col-md-6">

            @if ($sanghas->count())
            <div class="panel panel-default">
              <!-- Default panel contents -->
              <div class="panel-heading">Alle sanghas</div>

              <!-- Table -->
              <table class="table">
                @foreach($sanghas as $sangha)
                 <tr>
                    <td>{!!link_to("/sanghas/{$sangha->id}", $sangha->sanghaname) !!}</td>
                    <td>@include('sanghas.partials.join-sangha')</td>
                </tr>
                @endforeach
              </table>
            </div>
            @else
                Er zijn geen sangha's
            @endif

        	<div class="form-group">
        	    {!! link_to_route('createsangha_path', 'Maak een nieuwe sangha aan', null, ['class' => 'btn btn-primary']) !!}
        	</div>
	    </div>
	</div>
@stop
