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
		<div class="col-md-9 Messages">
		@if (Auth::user()->friends()->count())
			<div class="col-sm-4 col-xs-12 MessagesFriendList">
				
				<div class="MessagesFriendListBig">
					@foreach (Auth::user()->friends()->sortByDesc('online') as $friend)
					<div class="row MessageFriendClick @if (!$friend->isOnline()) offline @endif" data-id="{{ $friend->id }}">
						<div class="col-sm-3">
							<img src="{{ $friend->getAvatarImagePath() }}" class="img-circle">
						</div>
						<div class="col-sm-9">
							<p>{{ $friend->getFullName() }} @if (Auth::user()->PendingMessages($friend) > 0) ({{Auth::user()->PendingMessages($friend)}}) @endif</p>
						</div>
					</div>
					@endforeach
				</div>

				<div class="MessagesFriendListXM">
					@foreach (Auth::user()->friends()->sortByDesc('online') as $friend)
					<div class="slide">
						<img data-id="{{ $friend->id }}" src="{{ $friend->getAvatarImagePath() }}" class="img-circle @if (!$friend->isOnline()) offline @endif MessageFriendClick">
					</div>
					@endforeach
				</div>
				
			</div>
			<div class="col-sm-8 col-xs-12">
				<ul class="chat">
					<div class="chatText">
						<p class="text-center">Choose a friend to view the conversation</p>
					</div>
					<div class="chatTextbox" style="display: none;">
						<div class="input-group" style="margin-right: 8px">
							<input type="text" name="" id="MsgBody" class="form-control" required="required" placeholder="Write your message">
							<span class="input-group-btn">
								<button class="btn btn-signature" id="MsgSend"><i class="fa fa-location-arrow" aria-hidden="true"></i> Send</button>
							</span>
						</div>
					</div>
	            </ul>

			</div>
		@else
			<p>You don't have any friends to talk to.</p>
			<p>But stay tight! <a href="mailto:rgmachado92@hotmail.com">rgmachado92@hotmail.com</a> Drop me an email! Anytime you want.</p>
		@endif
			
		</div>
	</div>
</div>


@endsection


@section('scripts')

<script type="text/javascript">

	$(document).ready(function(){

		var friendId = 0;

		$('.MessageFriendClick').click(function(){
			$('.MessageFriendClick').removeClass('active');
			$(this).addClass('active');
			friendId = $(this).attr('data-id');
			updateChat(1);
			$('.chatTextbox').show();
		});

		function updateChat(scrollBol){
			$.ajax({
				type: "POST",
				url: "{{ route('message.start') }}",
				data: {id: friendId},
				dataType: 'JSON',
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				success: function(e){
					var data = e;
					if (data.success){
						$('.chatText').html(data.html);
						if (scrollBol == 1){
							$(".chat").scrollTop($(".chat")[0].scrollHeight);
						}
					}
				}
			});
		}

		$('#MsgSend').click(function(){
			var MsgBody = $("#MsgBody").val();

			$.ajax({
				type: "POST",
				url: "{{ route('message.send') }}",
				data: {MsgBody: MsgBody, friend:friendId},
				dataType: 'JSON',
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				success: function(e){
					if (e.success){
						updateChat(1);
						$("#MsgBody").val("");
					}
				},
				error: function(e){
					if (e.failed){
						location.reload();
					}
				}
			});

		});
		
		// Update chat every 10 seconds
		window.setInterval(function(){
				updateChat(0);
		}, 10000);
	});

</script>

@endsection