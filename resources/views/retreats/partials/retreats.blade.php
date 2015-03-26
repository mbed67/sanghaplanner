<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading">Evenementen voor deze sangha</div>

  <!-- Table -->

    <table class="table">
      <tr><th>Evenement</th><th>Begin</th><th>Eind</th></tr>
      @forelse($retreats as $retreat)
        @include('retreats.partials.retreat', ['sangha' => $sangha])
      @empty
        <tr><td colspan="2">Er zijn nog geen evemenenten.</td></tr>
      @endforelse
    </table>
</div>