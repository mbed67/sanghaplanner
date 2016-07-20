<script type="text/javascript">
    var sanghaInitialState = {
        isAdminOfThisSangha: {{ $isAdminOfThisSangha }},
        isMemberOfThisSangha: {{ $isMemberOfThisSangha }},
        sangha: {!! $sangha !!},
        notifications: { notifications: {!! json_encode($notifications) !!}},
        admins: {!! $admins !!},
        members: {!! json_encode($members) !!},
        retreats: {!! $retreats !!},
        routes: {
            editSanghaRoute: "{{ route('edit_sangha_path', $sangha->id) }}",
            createRetreat: "{{ route('sanghas.retreats.create', $sangha->id) }}",
            fetchNotificationsForSangha: "{{ route('fetch_notifications_for_sangha_path', '0') }}",
            leaveSangha: "{{ route('leave_sangha_path', $sangha->id) }}"
        }
    };
</script>
