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
		<div class="col-md-9">
		@if ($posts->count())
			<div class="posts">
			@foreach ($posts as $post)
				@include('layouts.posts', ['post' => $post])
			@endforeach
			</div>
		@else
			<p class="text-center">There are no Posts.</p>
		@endif
		</div>	
	</div>
</div>


@endsection