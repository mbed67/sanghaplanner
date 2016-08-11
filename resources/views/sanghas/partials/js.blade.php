<script type="text/javascript">
    var sanghaInitialState = {
        isAdminOfThisSangha: {{ $isAdminOfThisSangha }},
        isMemberOfThisSangha: {{ $isMemberOfThisSangha }},
        sangha: {!! $sangha !!},
        notifications: { notifications: {!! json_encode($notifications) !!}},
        admins: {!! $admins !!},
        members: { members: {!! json_encode($members) !!}},
        retreats: { retreats: {!! json_encode($retreats) !!}},
        routes: {
            editSanghaRoute: "{{ route('edit_sangha_path', $sangha->id) }}",
            createRetreat: "{{ route('create_retreat_path', $sangha->id) }}",
            fetchNotificationsForSangha: "{{ route('fetch_notifications_for_sangha_path', '0') }}",
            leaveSangha: "{{ route('leave_sangha_path', $sangha->id) }}",
            getSanghaMembers: "{{ route('get_sangha_members_path', $sangha->id) }}",
            updateMembership: "{{ route('updatemembership_path') }}"
        },
        modals: {
            CreateRetreat: {
                bsSize: "lg",
                show: false
            }
        }
};
</script>
