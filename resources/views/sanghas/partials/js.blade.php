<script type="text/javascript">
    var sanghaInitialState = {
        isAdminOfThisSangha: {{ $isAdminOfThisSangha }},
        isMemberOfThisSangha: {{ $isMemberOfThisSangha }},
        sangha: {!! $sangha !!},
        notifications: {!! json_encode($notifications) !!},
        admins: {!! $admins !!},
        retreats: {!! $retreats !!},
        routes: {
            editSanghaRoute: "{{ route('edit_sangha_path', $sangha->id) }}",
            createRetreat: "{{ route('sanghas.retreats.create', $sangha->id) }}"
        }
    };
</script>
