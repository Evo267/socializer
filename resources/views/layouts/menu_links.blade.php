<ul class="nav nav-pills nav-stacked links">
	<li role="presentation" @if ($active == 'index') class="active" @endif><a href="{{ route('index') }}"><i class="fa fa-fw fa-user" aria-hidden="true"></i> News Feed</a></li>
	<li role="presentation" @if ($active == 'messages') class="active" @endif><a href="{{ route('messages') }}"><i class="fa fa-fw fa-envelope" aria-hidden="true"></i> Messages</a></li>
	<li role="presentation"><a href="{{ route('photos', ['id' => Auth::user()->id]) }}"><i class="fa fa-fw fa-picture-o" aria-hidden="true"></i> Photos</a></li>
	<li role="presentation"><a href="{{ route('friends', ['id' => Auth::user()->id]) }}"><i class="fa fa-fw fa-users" aria-hidden="true"></i> Friends</a></li>
	<!--<li role="presentation" @if ($active == 'events') class="active" @endif><a href="{{ route('events.index') }}"><i class="fa fa-fw fa-calendar" aria-hidden="true"></i> Events</a></li>-->
	<li role="presentation" @if ($active == 'saved') class="active" @endif><a href="{{ route('saved') }}"><i class="fa fa-fw fa-floppy-o" aria-hidden="true"></i> Saved</a></li>
</ul>