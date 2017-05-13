<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Request as AjaxRequest;
use App\User;
use Auth;

class FriendsController extends Controller
{

	public function status($personId){

		$user = User::findOrFail($personId);

		return view('layouts.friend_status')->with('user', $user);
	}

	public function SendRequest(){

		$personId = AjaxRequest::get('id');

		$user = User::findOrFail($personId);

		if (Auth::user()->id == $personId){
			return false;
		}

		if (Auth::user()->hasFriendRequestPending($user) || $user->hasFriendRequestPending(Auth::user())){
			return false;
		}

		Auth::user()->addFriend($user);

		return view('layouts.friend_status')->with('user', $user);
	}

	public function CancelRequest(){
		$personId = AjaxRequest::get('id');

		$user = User::findOrFail($personId);

		if (Auth::user()->id == $personId){
			return false;
		}

		if (Auth::user()->hasFriendRequestPending($user)){
			Auth::user()->removeFriend($user);
		} else {
			return false;			
		}

		return view('layouts.friend_status')->with('user', $user);
	}

	public function RemoveFriend(){
		$personId = AjaxRequest::get('id');

		$user = User::findOrFail($personId);

		if (Auth::user()->id == $personId){
			return false;
		}

		if (Auth::user()->isFriendsWith($user)){
			Auth::user()->removeFriend($user);
		} else {
			return false;			
		}

		return view('layouts.friend_status')->with('user', $user);
	}

	public function AcceptFriend(){
		$personId = AjaxRequest::get('id');

		$user = User::findOrFail($personId);

		if (Auth::user()->id == $personId){
			return false;
		}

		if (!Auth::user()->isFriendsWith($user)){
			Auth::user()->acceptFriend($user);
		}

		return view('layouts.friend_status')->with('user', $user);
	}

}
