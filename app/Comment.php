<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Post;
use Auth;

class Comment extends Model
{

	protected $fillable = [
		'user_id', 'post_id', 'body'
	];

	public function canDelete($postId){
		$comment = Comment::findOrFail($this->id);
		$post = Post::findOrFail($postId);

		if (Auth::user()->id == $post->user_id){
			// creator of the post, so can delete any comment on his own post!
			return true;
		} elseif (Auth::user()->id == $comment->user_id){
			// can delete own comment
			return true;
		} else {
			return false;
		}

	}

	public function post(){
		return $this->belongsTo('App\Post');
	}

	public function user(){
		return $this->belongsTo('App\User');
	}

	public function notifications(){
		return $this->morphMany('App\Notification', 'notification');
	}
}
