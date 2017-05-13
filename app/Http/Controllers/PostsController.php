<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Response;

use Request as AjaxRequest;
use App\Post;
use Auth;

class PostsController extends Controller
{

    public function updateInfo(){

        $id = AjaxRequest::input('id');

        $post = Post::findOrFail($id);

        return $post->infoStatus();
    }

    public function getTags($body){

        preg_match_all('/#(\w+)/', $body, $matches);

        $tags = array();

        for ($i = 0; $i < count($matches[1]); $i++){
            
            $tag = $matches[1][$i];

            array_push($tags, $tag);
        }

        return $tags;

    }

    public function store(Request $request)
    {

        $rules = array(
            'body' => 'required|min:3|max:255',
            'image' => 'image'
        );

        $validator = Validator::make(Input::all(), $rules);

        // Validate the input and return correct response
        if ($validator->fails()){
            return Response::json(array(
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()
            ), 400); // 400 being the HTTP code for an invalid request.
        }

        $post = Post::create([
            'body' => $request->input('body'),
            'user_id' => Auth::user()->id
        ]);

        $tags = $this->getTags($request->input('body'));

        foreach($tags as $tag){
            $post->tags()->create([
                'name' => $tag
            ]);
        }

        if ($request->hasFile('image')){
            $image = $request->file('image');
            if ($image->isValid()){
                $filename = time() . '.' . $image->getClientOriginalExtension();
                $image->move('img/posts/', $filename);

                $post->images()->create(['filename' => $filename]);
            }            
        }

        return Response::json(array(
                'success' => true,
        )); // 400 being the HTTP code for an invalid request.

    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        
        $post = Post::findOrFail($id);

        if ($post->user_id == Auth::user()->id){
            // DELETE POST AND STUFF
            $post->likes()->delete();
            $post->comments()->delete();
            $post->tags()->delete();
            $post->delete();
        }

        return redirect()->back();

    }
}
