@if (Auth::user())
    @if (! Auth::user()->sanghas->find($sangha->id))
        {!! Form::open(['route' => 'notifications_path']) !!}
            {!! Form::hidden('sanghaIdToJoin', $sangha->id) !!}
            <button type="submit" class="btn btn-default btn-xs">Lid worden</button>
        {!! Form::close() !!}
    @endif
@endif