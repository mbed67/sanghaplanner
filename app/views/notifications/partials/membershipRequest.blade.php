<article class="media status-media">
    <div class="pull-left">
        @include('users.partials.avatar', ['user' => $notification->sender])
    </div>

    <div class="media-body">
        <h4 class="media-heading">{{ $notification->sender->firstname }} {{ $notification->sender->middlename }} {{ $notification->sender->lastname }}</h4>
    </div>
</article>

{{ Form::open(['route' => 'memberships_path']) }}
	{{ Form::hidden('userId', $notification->sender_id) }}
	{{ Form::hidden('sanghaId', $notification->object_id) }}
	<div class="button-group btn-group-xs">
        <button type="submit" name="approve_button" value="approve" class="btn btn-primary">Goedkeuren</button>
        <button type="submit" name="reject_button" value="reject" class="btn btn-default">Afwijzen</button>
    </div>
{{ Form::close() }}
