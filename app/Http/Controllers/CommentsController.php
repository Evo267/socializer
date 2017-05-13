<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use Auth;
use App\Post;
use App\Notification;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'post_id' => 'required|integer|exists:posts,id',
            'body' => 'required|min:3|max:255'
        ]);

        $post = Post::findOrFail($request->input('post_id'));

        $comment = Comment::create([
            'post_id' => $request->input('post_id'),
            'body' => $request->input('body'),
            'user_id' => Auth::user()->id
        ]);


        // to stop from getting a notification when the user comments his own post.
        if ($post->user_id !== Auth::user()->id){
            // If there is not yet a notification, well then create one!!
            $comment->notifications()->create([
                'user_id' => $post->user_id,
                'from' => Auth::user()->id
            ]);
            
        }

        // anchor to the post sometime soon
        return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $comment = Comment::findOrFail($id);

        $post = Post::findOrFail($comment->post->id);


        if ($comment->user_id == Auth::user()->id || $comment->post->user_id == Auth::user()->id){
            $comment->delete();
            Notification::where('user_id', $post->user_id)->where('from', Auth::user()->id)->where('notification_type', 'App\Comment')->delete();
        }

        return redirect()->back();
        
    }
}
