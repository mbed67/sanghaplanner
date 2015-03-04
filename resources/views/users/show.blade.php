@extends('layouts.default')

@section('content')
    <div class="row">
        <div class="media">
            <div class="pull-left">
                @include('users.partials.avatar', ['size' => 50])
            </div>
            <div class="media-body">
                <h1 class="media-heading">{{ $user->firstname }} {{ $user->middlename }} {{ $user->lastname }}</h1>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-default">
              <!-- Default panel contents -->
              <div class="panel-heading">Persoonlijke gegevens</div>

              <!-- Table -->
              <table class="table">
                <tr>
                    <td>Email</td>
                    <td>{{ $user->email }}</td>
                </tr>

                @if (Auth::id() == $user->id)
                    <tr>
                        <td>Voornaam</td>
                        <td>{{ $user->firstname }}</td>
                    </tr>
                    <tr>
                        <td>Tussenvoegsel</td>
                        <td>{{ $user->middlename }}</td>
                    </tr>
                    <tr>
                        <td>Achternaam</td>
                        <td>{{ $user->lastname }}</td>
                    </tr>
                    <tr>
                        <td>Adres</td>
                        <td>{{ $user->address }}</td>
                    </tr>
                    <tr>
                        <td>Postcode</td>
                        <td>{{ $user->zipcode }}</td>
                    </tr>
                    <tr>
                        <td>Plaats</td>
                        <td>{{ $user->place }}</td>
                    </tr>
                    <tr>
                        <td>Vaste telefoon</td>
                        <td>{{ $user->phone }}</td>
                    </tr>
                    <tr>
                        <td>Mobiel nummer</td>
                        <td>{{ $user->gsm }}</td>
                    </tr>
                @endif
              </table>
            </div>

            @if (Auth::id() == $user->id)
            <div class="form-group">
        	    {!! link_to_route('edit_profile_path', 'Wijzig gegevens', e($user->id), ['class' => 'btn btn-primary']) !!}
        	</div>
        	@endif

        </div>

        <div class="col-md-5">
            <div>
                @include('sanghas.partials.sanghas', ['sanghas' => $user->sanghas])
            </div>
        </div>
    </div>

@stop