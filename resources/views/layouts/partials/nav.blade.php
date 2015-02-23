<nav class="navbar navbar-default navbar-fixed-top navbar-inverse" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ Auth::check() ? route('sanghas_path') : route('home') }}">Sanghaplanner</a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="active">{!! link_to_route('users_path', 'Ledenlijst') !!}</li>
                <li class="active">{!! link_to_route('sanghas_path', 'Sangha\'s') !!}</li>
                </ul>

        @if (isset($searchable))
            {!! Form::open(['method' => 'GET', 'class' => 'navbar-form navbar-left', 'role' => 'search'])  !!}
                {!! Form::input('search', 'q', null, ['placeholder' => 'Zoek ...']) !!}
            {!! Form::close() !!}
        @endif

            <ul class="nav navbar-nav navbar-right">
            @if (Auth::user())
            <li class="dropdown">
            	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
            		Meldingen <span class="badge">{{ Auth::user()->notifications()->unread()->count() }}</span>
            	</a>
            	@include('notifications.partials.notifications', ['notifications' => Auth::user()->notifications()->unread()->orderBy('sent_at', 'desc')->get()])
            </li>
            <li class="dropdown">

                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                    <img class="nav-gravatar" src="{!! Auth::user()->present()->gravatar() !!}" alt="{{ Auth::user()->email }}">

                    {{ Auth::user()->email }}<span class="caret"></span>
                </a>
                  <ul class="dropdown-menu" role="menu">
                      <li>{!! link_to_route('profile_path', 'Profiel', Auth::user()->id ) !!}</li>
                      <li class="divider"></li>
                      <li>{!! link_to('/auth/logout', 'Uitloggen') !!}</li>
                  </ul>
            </li>
            @else
                <li>{!! link_to('/auth/register', 'Aanmelden') !!}</li>
                <li>{!! link_to('/auth/login', 'Login') !!}</li>
            @endif
            </ul>
        </div>
</nav>