<div class="media">
	<div class="media-left">
		<a href="{{ route('profile.view', ['id' => $comment->user->id]) }}">
			<img src="{{ $comment->user->getAvatarImagePath() }}" class="pull-left img-circle" height="45px">
		</a>
	</div>
	<div class="media-body">
		@if ($comment->canDelete($post->id))
		{!! Form::open(['method' => 'DELETE', 'action' => ['CommentsController@destroy', 'id' => $comment->id]]) !!}
		@endif
		<h4 class="media-heading">
		<a class="darker_link" href="{{ route('profile.view', ['id' => $comment->user->id]) }}">
			<b>{{ $comment->user->getFullName() }}</b>
		</a>
		<i> <small>- {{ $comment->created_at->diffForHumans() }}
		@if ($comment->canDelete($post->id))
		- <button type="button" data-toggle="modal" data-target="#confirmDelete" data-title="Delete Comment" data-message="Are you sure you want to delete this comment?">
				<i class="fa fa-trash-o" aria-hidden="true"></i> Delete
			</button>
			{!! Form::close() !!}
		@endif
		</small></i></h4>
		<p>{{ $comment->body }}</p>
	</div>
</div>