<li class="list-group-item">
	    @if($notification->type == "MembershipRequest" && $notification->hasValidObject())
	       <a href="/sanghas/{{ $notification->getObject()->id }}">
				<p class="timestamp">{!! $notification->present()->timeWhenCreated() !!}</p>
				<p class="notification-body">{{ $notification->body }}</p>
	       </a>
	    @else
	    	<p class="timestamp">{!! $notification->present()->timeWhenCreated() !!}</p>
	    	<p class="notification-body">{{ $notification->body }}</p>
	    @endif
</li>
