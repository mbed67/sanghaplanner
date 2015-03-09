@if (Auth::user())
    @if (Auth::user()->sanghas->find($sangha->id))
        {!! Form::open(['method' => 'DELETE', 'route' => ['membership_path', $sangha->id]]) !!}
            {!! Form::hidden('sanghaIdToUnjoin', $sangha->id) !!}
            {!! Form::hidden('userId', Auth::id()) !!}
            <button type="submit" class="btn btn-danger btn-sm">Sangha verlaten</button>
        {!! Form::close() !!}
    @endif
@endif