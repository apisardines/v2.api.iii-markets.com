<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Models;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class AuthController1 extends Controller
{
    public function login()
    {
    	if(Input::has('username'))
    	{
    		$data = array('username' => Input::get('username'),'passw' => Input::get('passw'));
    		if (Auth::attempt($data)) {
    			return Redirect::action('');
    		}
    		else
    		{
    			return Response::json(['response' => 'loi roi 1'],404);
    		}
    	}
    	else
    	{
    		return Response::json(['response' => 'loi roi 2'],404);
    	}
    }

}
