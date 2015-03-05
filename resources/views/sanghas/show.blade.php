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
            <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                Nulla sollicitudin eu ipsum ut porta.
                Nulla fermentum neque ut neque tincidunt, eget dictum turpis placerat.
                Maecenas volutpat augue id elementum cursus.
                Sed aliquam purus eget enim egestas fermentum.
                Aenean pharetra nisl in maximus rutrum.
                Maecenas finibus leo ac ullamcorper eleifend.
                Proin vulputate rutrum tortor, sed gravida erat tincidunt et.
            </p>
        </div>
        <div role="tabpanel" class="tab-pane" id="sanghaleden">
            <div class="row">
                <div class="col-md-9">
                        <div>
                            @include('users.partials.users', ['users' => $sangha->users])
                        </div>
                        <div>
                        	@include('sanghas.partials.leave-sangha')
                        </div>
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
              <p>
                  Proin ex mauris, elementum non nisi vitae, dictum hendrerit nulla.
                  Etiam fringilla libero vel eros malesuada, id viverra sem sollicitudin.
                  Sed libero enim, laoreet at vulputate vel, congue ut lectus.
                  Praesent magna dui, auctor non lacinia at, euismod et purus.
                  In hac habitasse platea dictumst.
                  Suspendisse tristique lectus eu neque sollicitudin porta.
                  Nam convallis blandit ullamcorper.
                  Morbi facilisis gravida nibh, in auctor leo porta semper.
                  Phasellus sit amet blandit lacus.
              </p>
          </div>
    </div>

@stop


