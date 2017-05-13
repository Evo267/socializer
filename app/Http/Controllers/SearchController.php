<?php

namespace App\Http\Controllers;

use Request;
use DB;
use App\User;
use Auth;

class SearchController extends Controller
{
    public function search(){
    	$q = Request::input('q');

    	if (strlen($q) < 3){
    		return 'Search must have at least 3 chars.';
    	}
    	
    	$users = User::where(DB::raw("CONCAT(`first_name`, ' ', `last_name`)"), 'LIKE', '%'.$q.'%')->whereNotIn('id', [Auth::user()->id])->get();

    	return view('layouts.search_results')->with('users', $users)->with('q', $q);

    }
}
