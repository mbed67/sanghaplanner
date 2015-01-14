<tr>
    <td> {{ $user->firstname }} {{ $user->middlename }} {{ $user->lastname }}</td>
    <td> {{ $user->pivot->role->rolename }} </td>
</tr>
