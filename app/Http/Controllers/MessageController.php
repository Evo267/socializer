<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Response;

use App\Message;
use App\User;
use Auth;

class MessageController extends Controller
{
    public function index(){
    	return view('app.messages')->with('active', 'messages');
    }

    public function startChat(Request $request){
    	
    	if (!$request->input('id')){
    		return Response::json(array(
    			'success' => false,
    			'failed' => true
    		));
    	}

    	if (!$friend = User::whereId($request->input('id'))->first()){
    		return Response::json(array(
    			'success' => false,
    			'failed' => true
    		));
    	}

    	if (!Auth::user()->isFriendsWith($friend)){
			return Response::json(array(
    			'success' => false,
    			'failed' => true
    		));
    	}

    	$messages = Auth::user()->conversation($friend);

    	return Response::json(array(
				'success' => true,
    			'failed' => false,
    			'html' => (String) view('layouts.chatline')
    							->with('messages', $messages)
    							->with('user', Auth::user())
    							->with('friend', $friend)
    	));
    }

    public function sendMsg(Request $request){

        $rules = array('MsgBody' => 'required|max:140');
        $validator = Validator::make(Input::all(), $rules);

        // Validate the input and return correct response
        if ($validator->fails()){
            return Response::json(array(
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()
            ), 400); // 400 being the HTTP code for an invalid request.
        }

        if (!$friend = User::whereId($request->input('friend'))->first()){
            return Response::json(array(
                'success' => false,
                'failed' => true
            ));
        }

        if (!Auth::user()->isFriendsWith($friend)){
            return Response::json(array(
                'success' => false,
                'failed' => true
            ));
        }

        Auth::user()->messages()->create([
            'receiver' => $request->input('friend'),
            'msg' => $request->input('MsgBody'),
        ]);

        return Response::json(array(
            'success' => true
        ));

    }
}
