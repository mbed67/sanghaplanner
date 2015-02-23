<ul class="dropdown-menu" role="menu">
	@forelse($notifications as $notification)
        @include('notifications.partials.notification')
    @empty
        <li>Er zijn geen meldingen</li>
    @endforelse
    	<li>
    		<div class="notification-footer">
    			<a href="/notifications">Zie alle meldingen</a>
    		</div>
    	</li>
</ul>
