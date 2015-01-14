<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading">Sangha's waar je lid van bent</div>

  <!-- Table -->

    <table class="table">
      <tr><th>Sangha</th><th>rol</th></tr>
      @forelse($sanghas as $sangha)
        @include('sanghas.partials.sangha')
      @empty
        <tr><td colspan="2">Je bent nog geen lid van een sangha.</td></tr>
      @endforelse
    </table>
</div>