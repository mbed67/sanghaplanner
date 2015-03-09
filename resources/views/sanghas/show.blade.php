@extends('layouts.default')


@section('content')

    <div class="row">
        <div class="col-md-9">
            <h1>{{ $sangha->sanghaname }} </h1>
            <div>
                <ul class="nav nav-tabs" role="tablist" id="sanghaTab">
                  <li role="presentation" class="active"><a href="#algemeen" aria-controls="algemeen" role="tab" data-toggle="tab">Algemeen</a></li>
                  <li role="presentation"><a href="#sanghaleden" aria-controls="sanghaleden" role="tab" data-toggle="tab">Sanghaleden</a></li>
                  <li role="presentation"><a href="#evenementen" aria-controls="evenementen" role="tab" data-toggle="tab">Evenementen</a></li>
                </ul>
           </div>
        </div>
    </div>


    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="algemeen">
            <div class="row">
                <div class="col-md-9">
                   <div class="panel panel-default">
                      <!-- Default panel contents -->
                      <div class="panel-heading">Contactgegevens</div>

                      <!-- Table -->
                      <table class="table">
                        <tr>
                            <td>Adres</td>
                            <td>
                                {{ $sangha->address }}<br>
                                {{ $sangha->zipcode }} {{ '&nbsp;' . $sangha->place }}
                            </td>
                        </tr>
                        @include('users.partials.admins', ['admins' => $admins])
                      </table>
                    </div>
                    @if(Auth::user()->roleForSangha($sangha->id) == 'administrator')
                        <div class="form-group">
                    	    {!! link_to_route('edit_sangha_path', 'Wijzig gegevens', e($sangha->id), ['class' => 'btn btn-primary']) !!}
                    	</div>
                    @endif
                  </div>
                  <div class="col-md-3">
                    @if ($sangha->filename)
                        <div class="media">
                            <img class="media-object" src="/images/{!! str_replace(' ', '_', e($sangha->sanghaname)) !!}/{{ $sangha->filename }}" alt="{{ $sangha->sanghaname }}">
                        </div>
                    @endif
                  </div>
            </div>
        </div>
        <div role="tabpanel" class="tab-pane" id="sanghaleden">
            <div class="row">
                <div class="col-md-9">
                    @if(Auth::user()->sanghas->find($sangha->id))
                        <div>
                            @include('users.partials.users', ['users' => $sangha->users])
                        </div>
                        <div>
                        	@include('sanghas.partials.leave-sangha')
                        </div>
                    @else
                        <div class="alert alert-warning">U moet lid zijn om deze pagina te kunnen bekijken</div>
                    @endif
                 </div>
                 <div class="col-md-3">
                    @if(Auth::user()->roleForSangha($sangha->id) == 'administrator')
        	            <div>
        	            	@include('notifications.partials.membershipRequests', ['notifications' => $notifications])
        	            </div>
                    @endif
                 </div>
             </div>
          </div>
          <div role="tabpanel" class="tab-pane" id="evenementen">
            <div class="row">
                <div class="col-md-9">
                    @if(Auth::user()->sanghas->find($sangha->id))
                        <div>
                          Proin ex mauris, elementum non nisi vitae, dictum hendrerit nulla.
                          Etiam fringilla libero vel eros malesuada, id viverra sem sollicitudin.
                          Sed libero enim, laoreet at vulputate vel, congue ut lectus.
                          Praesent magna dui, auctor non lacinia at, euismod et purus.
                          In hac habitasse platea dictumst.
                          Suspendisse tristique lectus eu neque sollicitudin porta.
                          Nam convallis blandit ullamcorper.
                          Morbi facilisis gravida nibh, in auctor leo porta semper.
                          Phasellus sit amet blandit lacus.
                        </div>
                    @else
                        <div class="alert alert-warning">U moet lid zijn om deze pagina te kunnen bekijken</div>
                    @endif
                 </div>
             </div>
           </div>
    </div>

@stop


