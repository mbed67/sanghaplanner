<tr>
    <td> {!!link_to("/sanghas/{$sangha->id}/retreats/{$retreat->id}", $retreat->description) !!} </td>
    <td> {{ $retreat->retreat_start->format('d-m-Y H:i') }} </td>
    <td> {{ $retreat->retreat_end->format('d-m-Y H:i') }} </td>
    <td> @include('retreats.partials.join-retreat', ['retreatId' => $retreat->id])</td>
</tr>
