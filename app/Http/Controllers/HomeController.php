<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct(){

        if (!Auth::check()){            
            return view('welcome');
        }
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        if (Auth::check()){
            return view('app.index')->with('active', 'index');
        }

        return view('welcome');
    }


    public function photos($id){

        $user = User::findOrFail($id);
       
        return view('app.photos')->with('user', $user);
    }

    public function friends($id){
        $user = User::findOrFail($id);
       
        return view('app.friends')->with('user', $user);
    }

    public function saved(){
        return view('app.saved')->with('active', 'saved');
    }

    public function updateOnline(){
       Auth::user()->updateOnlineStatus();
    }

    public function notifications(){

        Auth::user()->notifications()->update([
            'seen' => true
        ]);

    }
}
