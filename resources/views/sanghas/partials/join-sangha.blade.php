@if (Auth::user())
    @if (Auth::user()->sanghas->find($sangha->id))
        {!! Form::open(['method' => 'DELETE', 'route' => ['membership_path', $sangha->id]]) !!}
            {!! Form::hidden('sanghaIdToUnjoin', $sangha->id) !!}
            <button type="submit" class="btn btn-danger">Verlaat sangha {{ $sangha->sanghaname }}</button>
        {!! Form::close() !!}
        @else
        {!! Form::open(['route' => 'notifications_path']) !!}
            {!! Form::hidden('sanghaIdToJoin', $sangha->id) !!}
            <button type="submit" class="btn btn-primary">Vraag lidmaatschap aan voor sangha {{ $sangha->sanghaname }}</button>
        {!! Form::close() !!}
    @endif
@endif