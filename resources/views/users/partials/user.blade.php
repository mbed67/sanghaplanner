<tr>
    <td class="col-md-2"> {{ $user->firstname }} {{ $user->middlename }} {{ $user->lastname }}</td>
    <td class="col-md-2"> {{ $user->address }} <br> {{ $user->zipcode }} {{ $user->place }}</td>
    <td class="col-md-2"> {{ $user->phone }} <br> {{ $user->gsm }} </td>
    <td class="col-md-2"> {{ $user->email }}</td>
    <td class="col-md-1"> {{ $user->pivot->role->rolename }} <br>
        @if(Auth::user()->roleForSangha($sangha->id) == 'administrator')
            @include('users.partials.admin')
        @endif
    </td>
</tr>


