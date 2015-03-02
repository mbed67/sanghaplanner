@if (Auth::user())
    @if (Auth::user()->roleForSangha($sangha->id) == 'administrator')
        {!! Form::open(['method' => 'PUT', 'route' => 'updatemembership_path']) !!}
            {!! Form::hidden('sanghaId', $sangha->id) !!}
            {!! Form::hidden('userId', $user->id) !!}
            <button type="submit" class="btn-dropdown">
                @if ($user->roleForSangha($sangha->id) == 'administrator')
                    Maak lid
                @else
                    Maak administrator
                @endif
            </button>
        {!! Form::close() !!}
    @endif
@endif