@extends('layouts.app')

@section('content')

<div class="container">
	<div class="row timeline">
		<div class="col-md-3">
		<div class="col-md-12 profile">
			<div class="profile-img text-center">
				<a href="{{ route('profile.view', ['id' => Auth::user()->id]) }}">
					<img src="{{ Auth::user()->getAvatarImagePath() }}" height="100px" class="img-circle">
				</a>
				<p>{{ Auth::user()->getFullName() }}</p>
			</div>
			@include('layouts.menu_links')
			</div>
		</div> <!-- profile -->
		<div class="col-md-9 Events">

			@if ($create == 0)
				<ul class="nav nav-tabs" role="tablist">
					<li role="presentation" class="active"><a href="#allevents" aria-controls="home" role="tab" data-toggle="tab">All Events</a></li>
					<li role="presentation"><a href="#invites" aria-controls="profile" role="tab" data-toggle="tab">Invites</a></li>
					<li role="presentation"><a href="#myevents" aria-controls="messages" role="tab" data-toggle="tab">My Events</a></li>
					<li role="presentation" class="pull-right"><a href="{{ route('events.create') }}">Create New Event</a></li>
				</ul>
				<div class="tab-content">
					<div role="tabpanel" class="tab-pane active" id="allevents">
						@if ($events->count())
							@foreach ($events as $event)
								<p>{{ $event->title }}</p>
							@endforeach
						@else
							<p>There are no events currently.</p>
						@endif
					</div>
					<div role="tabpanel" class="tab-pane" id="invites">invites</div>
					<div role="tabpanel" class="tab-pane" id="myevents"> my events</div>
				</div>
			@else
				<h1 class="text-center">Create New Event</h1>
				{!! Form::open(['method' => 'POST', 'action' => 'EventsController@store', 'files' => 'true']) !!}
					<div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
						{!! Form::label('title', 'Title:') !!}
						{!! Form::text('title', null, ['class' => 'form-control']) !!}
						@if ($errors->has('title'))
							<span class="help-block">
								{{ $errors->first('title') }}
							</span>
						@endif
					</div>
					<div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
						{!! Form::label('description', 'Description:') !!}
						{!! Form::textarea('description', null, ['class' => 'form-control']) !!}
					</div>
					<div class="form-group {{ $errors->has('data') ? 'has-error' : '' }}">
						{!! Form::label('data', 'Date / Time:') !!}
						{!! Form::date('data', null, ['class' => 'form-control']) !!}
					</div>
					<div class="form-group {{ $errors->has('place') ? 'has-error' : '' }}">
						{!! Form::label('place', 'Place:') !!}
						{!! Form::text('place', null, ['class' => 'form-control']) !!}
					</div>
					<div class="form-group {{ $errors->has('picture') ? 'has-error' : '' }}">
						{!! Form::label('picture', 'Image:') !!}
						{!! Form::file('picture') !!}
						<img src="{{ asset('img/events/default.png') }}" class="img-responsive img-center margin-top margin-bottom">
					</div>
					<div class="form-group">
						{!! Form::label('private', 'Private?') !!}
						{!! Form::checkbox('private', 'private', true); !!}
					</div>
					<p>
					{!! Form::submit('Create New Event', ['class' => 'btn btn-primary']) !!}
					</p>
					
				{!! Form::close() !!}
					<a href="{{ route('events.index') }}"><button class="btn btn-warning">Go Back!</button></a>
					
			@endif

		</div>	
	</div>
</div>


@endsection