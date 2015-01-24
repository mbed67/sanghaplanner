<li>
	<div class="nav-notification">
		<p class="timestamp">{{ $notification->present()->timeWhenCreated() }}</p>
		<p class="notification-body">{{ $notification->body }}</p>

	    @if($notification->type == "MembershipRequest" && $notification->hasValidObject())
	       <a href="/sanghas/{{ $notification->getObject()->id }}">Ga naar de sanghapagina</a>
	    @endif
    </div>
</li>
