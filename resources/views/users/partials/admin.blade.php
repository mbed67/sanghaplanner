<!-- Single button -->
<div class="btn-group">
  <button type="button" class="btn btn-settings dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
    <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
  </button>
  <ul class="dropdown-menu" role="menu">
    <li>@include('roles.partials.toggle')</li>
    <li>@include('sanghas.partials.remove-from-sangha')</li>
  </ul>
</div>