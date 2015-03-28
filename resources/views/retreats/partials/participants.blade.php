<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading">Deelnemers</div>

  <!-- Table -->

    <table class="table">
      <tr><th>Naam</th></tr>
      @forelse($participants as $participant)
        <tr>
            <td class="col-md-2"> {{ $participant->firstname }} {{ $participant->middlename }} {{ $participant->lastname }}</td>
        </tr>
      @empty
        <tr><td colspan="2">Dit evenement heeft geen deelnemers</td></tr>
      @endforelse
    </table>
</div>