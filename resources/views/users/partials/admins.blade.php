@forelse($admins as $admin)
    <tr>
        <td>Contactpersoon</td>
        <td>
            {{ $admin->firstname }} {{ $admin->middlename }} {{ $admin->lastname }}<br>
            <a href="mailto:{{ $admin->email }}">{{ $admin->email }}</a><br>
            @if ($admin->phone)
                {{ $admin->phone }}<br>
            @endif
            @if ($admin->gsm)
                {{ $admin->gsm }}
            @endif
        </td>
    </tr>
@empty
        <tr>
            <td>Contactpersonen</td>
            <td>Deze sangha heeft geen contactpersonen</td>
        </tr>
@endforelse

