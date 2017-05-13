@extends('layouts.app')

@section('content')


<div class="container">
	<div class="row timeline">
		<div class="col-md-3">
			<div class="col-md-12 profile followUser">
			<div class="profile-img text-center">
				<a href="{{ route('profile.view', ['id' => Auth::user()->id]) }}">
					<img src="{{ Auth::user()->getAvatarImagePath() }}" height="100px" class="img-circle">
				</a>
				<p>{{ Auth::user()->getFullName() }}</p>
			</div>
			@include('layouts.menu_links')
			</div>
		</div> <!-- profile -->
		<div class="col-md-9">
			@if (Auth::user()->saves->count())
				<div class="posts">
				@foreach (Auth::user()->saves as $save)
					@include('layouts.posts', ['post' => $save->post])
				@endforeach
				</div>
			@else
				<p class="text-center">You have no saved posts!</p>
			@endif

		</div>
	</div>
</div>


@endsection


