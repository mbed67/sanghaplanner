@if (Auth::user())
    @if (! in_array($retreat->id, $myRetreats))
        {!! Form::open(['route' => ['sanghas.retreats.tasks.store', $sangha->id, $retreat->id]]) !!}
            {!! Form::hidden('retreatId', $retreat->id) !!}
            {!! Form::hidden('userId', Auth::id()) !!}
            {!! Form::hidden('sanghaId', $sangha->id) !!}
            {!! Form::hidden('description', 'attending') !!}
            <button type="submit" class="btn btn-default btn-xs">Aanmelden</button>
        {!! Form::close() !!}
    @endif
@endif
