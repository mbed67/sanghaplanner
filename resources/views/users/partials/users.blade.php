<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading">Leden van deze sangha</div>

  <!-- Table -->

    <table class="table">
      <tr><th>Naam</th><th>Adres</th><th>Telefoon</th><th>Email</th><th>Rol</th></tr>
      @forelse($users as $user)
        @include('users.partials.user')
      @empty
        <tr><td colspan="2">Deze sangha heeft geen leden</td></tr>
      @endforelse
    </table>
</div>