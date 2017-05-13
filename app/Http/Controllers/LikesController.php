<?php

namespace App\Http\Controllers;

use Request;
use Auth;
use App\Post;
use App\Like;
use App\Notification;

class LikesController extends Controller
{

	public function LikePost(){

		if (Request::ajax()){

			$postId = Request::input('id');
			$post = Post::findOrFail($postId);
			$this->handleLike('App\Post', $postId);
			
			if ($like = Like::whereLikeableType('App\Post')->whereLikeableId($postId)->whereUserId(Auth::id())->first()){
				// notification for the like
				if ($post->user_id !== Auth::user()->id){

					if (!Notification::where('user_id', $post->user_id)->where('from', Auth::user()->id)->where('notification_type', 'App\Like')->where('seen', 0)->first()){
			            $like->notifications()->create([
			            	'user_id' => $post->user_id,
			            	'from' => Auth::user()->id
			            ]);
		            }

		        }
	            
				return 1;
			} else {
				Notification::where('user_id', $post->user_id)->where('from', Auth::user()->id)->where('notification_type', 'App\Like')->delete();

				return 0;
			}
		}
	}

	public function handleLike($type, $id){
		
		$existing_like = Like::whereLikeableType($type)->whereLikeableId($id)->whereUserId(Auth::id())->first();

		if (is_null($existing_like)) {
            $like = Like::create([
                'user_id'       => Auth::id(),
                'likeable_id'   => $id,
                'likeable_type' => $type,
            ]);
        } else {
        	Like::whereLikeableType($type)->whereLikeableId($id)->whereUserId(Auth::id())->delete();
        }

	}
}
