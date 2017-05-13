<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Response;
use App\User;
Use Auth;

class LoginController extends Controller
{
    public function login(Request $request){

        $rules = array('email' => 'required|email|max:50', 'password' => 'required|min:3|max:20');
		$validator = Validator::make(Input::all(), $rules);

		// Validate the input and return correct response
		if ($validator->fails()){
		    return Response::json(array(
		        'success' => false,
		        'errors' => $validator->getMessageBag()->toArray()
		    ), 400); // 400 being the HTTP code for an invalid request.
		}

		if (Auth::attempt(['email' => request()->email, 'password' => request()->password])) {

			if ($request->has('remember')){
				$remember = true;
			}

            return Response::json(array('success' => true), 200);
        } else {
        	return Response::json(array(
		        'success' => false,
		        'errors' => array('credentials' => 'Credentials did not match!')
		    ), 400); // 400 being the HTTP code for an invalid request.
        }

    }

    public function register(Request $request){
    	$rules = array('name' => 'required|min:7|max:30', 'email' => 'required|email|max:50|unique:users', 'password' => 'required|min:3|max:20');
		$validator = Validator::make(Input::all(), $rules);

		$parts = explode(" ", $request->input('name'));
		$lastname = array_pop($parts);
		$firstname = implode(" ", $parts);

		// Validate the input and return correct response
		if ($validator->fails()){
		    return Response::json(array(
		        'success' => false,
		        'errors' => $validator->getMessageBag()->toArray()
		    ), 400); // 400 being the HTTP code for an invalid request.
		}

		if(empty(trim($firstname)) or empty(trim($lastname))){
			return Response::json(array(
		        'success' => false,
		        'errors' => [
		        	'name' => 'Must have First and Last Name.'
		        ]
		    ), 400); // 400 being the HTTP code for an invalid request. 
		}


		$user = new User;
		$user->first_name = $firstname;
		$user->last_name = $lastname;
		$user->email = $request->input('email');
		$user->password = bcrypt($request->input('password'));

		$user->save();

		// Adding bots as friends!
		$user->friendsOfMine()->sync([
            1 => [ 'accepted' => "1"],
            2 => [ 'accepted' => "1"],
            3 => [ 'accepted' => "1"],
            4 => [ 'accepted' => "0"],
            5 => [ 'accepted' => "1"],
            6 => [ 'accepted' => "1"],
            7 => [ 'accepted' => "1"],
            8 => [ 'accepted' => "0"],
            9 => [ 'accepted' => "1"],
        ]);

		Auth::login($user);

		return Response::json(array('success' => true), 200);

    }

    public function logout(){
    	Auth::logout();
    	return Redirect('/');
    }
}
