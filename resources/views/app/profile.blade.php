@extends('layouts.app')

@section('content')
	
	<div class="container-fluid" id="Profile">
		<div class="row">
			@include('layouts.cover', ['active' => 'timeline'])
			<div class="col-md-8 col-md-offset-2" style="padding:0">
				<div class="col-md-8" style="padding:0">
				@if ($user->posts()->count())
					<div class="posts">
					@foreach ($user->posts as $post)
						@include('layouts.posts')
					@endforeach
					</div>
				@else
					<p>{{ $user->getFullName() }} has no posts.</p>
				@endif
				</div>
				<div class="col-md-4 sidebar" style="padding-left:20px; padding-right: 0;">
					@if ($user->id !== Auth::user()->id)
						<div id="friendStatusDiv">
							@include('layouts.friend_status', ['user' => $user, 'profileView' => 'true'])
						</div>
					@endif
					<div class="panel panel-default">
						<div class="panel-heading">
							Friends
						</div>
						<div class="panel-body">
							@foreach ($user->friends() as $friend)
								<a href="{{ route('profile.view', ['id' => $friend->id]) }}"><img src="{{ $friend->getAvatarImagePath() }}" title="{{ $friend->getFullName() }}" height="50px" style="margin-bottom:3px;"></a>
							@endforeach
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

@stop

@section('scripts')

<script type="text/javascript">
	function friendEvents(){
		$('.addFriend').click(function(){
			var id = $(this).attr('data-id');

			$.ajax({
				type: "POST",
				url: "{{ route('friend.add') }}",
				data: {id: id, _token: '{{ Session::token() }}'},
				success: function(response){
					location.reload();
				}
			});
		});

		$('.cancelFriend').click(function(){
			var id = $(this).attr('data-id');

			$.ajax({
				type: "POST",
				url: "{{ route('friend.cancel') }}",
				data: {id: id, _token: '{{ Session::token() }}'},
				success: function(response){
					location.reload();
				}
			});
		});

		$('.removeFriend').click(function(){
			var id = $(this).attr('data-id');

			$.ajax({
				type: "POST",
				url: "{{ route('friend.remove') }}",
				data: {id: id, _token: '{{ Session::token() }}'},
				success: function(response){
					location.reload();
				}
			});
		});

		$('.acceptFriend').click(function(){
			var id = $(this).attr('data-id');

			$.ajax({
				type: "POST",
				url: "{{ route('friend.accept') }}",
				data: {id: id, _token: '{{ Session::token() }}'},
				success: function(response){
					location.reload();
				}
			});
		});
	}

	friendEvents();
</script>

@append