<tr>
    <td> {!!link_to("/sanghas/{$sangha->id}", $sangha->sanghaname) !!} </td>
    <td> {{ $sangha->pivot->role->rolename }} </td>
</tr>
