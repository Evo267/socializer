@if ($users->count())
	@foreach ($users as $user)
		<div class="userresult row ">
			<div class="col-xs-2">
				<a href="{{ route('profile.view', ['id' => $user->id]) }}"><img src="{{ $user->getAvatarImagePath() }}" class="img-circle pull-left" height="35px"></a>
			</div>
			<div class="col-xs-6">
				<a href="{{ route('profile.view', ['id' => $user->id]) }}"><p class="text-center">{{ $user->getFullName() }}</p></a>
			</div>
			<div class="col-xs-4" id="friendStatusDiv{{ $user->id }}">
				@include('layouts.friend_status')</span>
			</div>
		</div>
	@endforeach
@else
	<p>There are no users for the search '{{ $q }}'.</p>
@endif