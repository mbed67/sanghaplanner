<div>
  <h3>Lidmaatschapsverzoeken</h3>
      @forelse($notifications as $notification)
        @include('notifications.partials.membershipRequest')
      @empty
        <p>Er zijn geen verzoeken</p>
      @endforelse
</div>