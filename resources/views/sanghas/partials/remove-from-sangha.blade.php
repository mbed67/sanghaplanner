@if (Auth::user())
    @if (Auth::user()->roleForSangha($sangha->id) == 'administrator')
        {!! Form::open(['method' => 'DELETE', 'route' => ['membership_path', $sangha->id]]) !!}
            {!! Form::hidden('sanghaIdToUnjoin', $sangha->id) !!}
            {!! Form::hidden('userId', $user->id) !!}
            <button type="submit" class="btn-dropdown">Verwijder uit sangha</button>
        {!! Form::close() !!}
    @endif
@endif