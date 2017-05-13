@extends('layouts.app')

@section('content')

	<div class="container-fluid" id="Profile">
		<div class="row">
			@include('layouts.cover', ['active' => 'photos'])

			<div class="col-md-8 col-md-offset-2" style="padding:0">
			@if ($user->imagesFromPosts()->count())
				@foreach ($user->imagesFromPosts() as $post)
					@foreach ($post->images as $img)

						@if ($user->imagesFromPosts()->count() == 1)
							<div class="col-md-12">
						@else
							@if ($user->imagesFromPosts()->count() == 2)
								<div class="col-md-6">
							@else
								@if ($user->imagesFromPosts()->count() == 3)
									<div class="col-md-4">
								@else
									<div class="col-sm-3">
								@endif
							@endif
						@endif
							<a href="{{ asset($post->imagePath($img)) }}" data-lightbox="PostImage" data-title="{{ $post->body }}"><img class="img-responsive" src="{{ asset($post->imagePath($img)) }}"></a>
						</div>
					@endforeach
				@endforeach
			@else
				<p class="text-center">{{ $user->getFullName() }} has no photos.</p>
			@endif

			</div>
		</div>
	</div>
@stop