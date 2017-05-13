<?php

namespace App\Http\Controllers;

use Request;
use App\Post;
use App\Save;
use Auth;

class SaveController extends Controller
{
    public function save(){
    	$postId = Request::input('id');

    	$post = Post::findOrFail($postId);

    	$this->handleSave($postId);

    	if ($post->saves()->whereUserId(Auth::user()->id)->wherePostId($postId)->first()){
    		return 1;
    	} else {
    		return 0;
    	}
    }

    public function handleSave($postId){
		
		$existing_save = Save::whereUserId(Auth::user()->id)->wherePostId($postId)->first();

		if (is_null($existing_save)) {
            Save::create([
                'user_id' => Auth::id(),
                'post_id' => $postId
            ]);
        } else {
        	Save::whereUserId(Auth::user()->id)->wherePostId($postId)->delete();
        }

	}
}
