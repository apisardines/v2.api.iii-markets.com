<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use UserController;
use App\Models;
use Response;

class AuthControllerTest extends Controller
{
	//Controller UserDB----------------

	//----------------------------------

	//Controller UserCheck--------------
	public function AuthCheck($loginname,$userpass)
	{
		//return 'login user';
		if ($loginname == 'su') {	
			return Response::json(['response' => 'su'],404);
			# code...
			//return redirect()->action('UserController@deleteUsers1');
			//Route::get('{loginname}&&{userpass}',['uses' => 'AuthControllerTest@AuthCheck']);
			//return redirect()->route('book_view', 1);
			//return Redirect::route('UserController@loginUser');
			//return Redirect::action('UserController@deleteUsers',[1]);
			//App::make('UserController')->loginUser($loginname,$userpass);
			//return redirect()->route(Route::make(Route::get('{loginname}&&{userpass}',['as' => 'User_Login','uses' => 'UserController@loginUser'])),,['su','123']);
			//return redirect()->route('User_Login',['su','123']);
			//Route::get('{loginname}&&{userpass}',['as' => 'User_Login','uses' => 'AuthControllerTest@loginUser']);
		}
		else
		{
			return Response::json(['response' => 'loi roi'],404);			
		}
	}

	//----------------------------------
}

