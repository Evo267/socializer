<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;
use App\Post;

class TagsController extends Controller
{
	public function Search($tag){
		$tag = Tag::where('name', $tag)->groupBy('post_id')->get();
		$posts = Post::whereIn('id', $tag->pluck('post_id'))->get();
		
		return view('app.tags')->with('active', 'index')->with('posts', $posts);

	}
}
