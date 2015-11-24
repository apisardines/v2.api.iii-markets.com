<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
//Route::get('test/{loginname}&{userpass}','UserController@test');
Route::get('test',function(){
	return 'Hello World';
});
Route::get('UserLogin/{loginname}&{userpass}','UserController@UserLogin');
Route::get('UserLogin1/{loginname}&{userpass}','UserController@UserLogin1');
Route::post('UserLogin2','UserController@UserLogin2');
Route::get('GetUserByID/{id}','UserController@getUsersByID');
Route::get('TestSVN',function(){
	return 'Test SVN';
});

//Route::get('UserLogin/{loginname}&{userpass}','UserController@UserLogin');
Route::group(['prefix' => 'api'],function()
{
	// /api/user/	
	Route::group(['prefix' => 'users'],function()
	{	
		Route::post('Login',['as' => 'RUserLogin','uses' => 'UserController@func_Login']);
		Route::post('Register',['as' => 'RUserRegister','uses' => 'UserController@func_Insert_New']);
		Route::post('Update',['as' => 'RUserUpdate','uses' => 'UserController@func_Update']);
		Route::post('SendEmail',['as' => 'RUserSendEmail','uses' => 'CompanyController@func_SendEmail']);
		//Route::post('GetList',['as' => 'RGetList','uses' => 'CompanyController@func_CompanyAll']);					
		/*
		Route::group(['prefix' => 'usercheck'],function()
		{						
				//Route::get('{loginname}&&{userpass}',['as' => 'AuthCheck_User','uses' => 'AuthControllerTest@AuthCheck']);
				Route::post('UserLogin',['as' => 'User_Login','uses' => 'UserController@func_Login']);					
				
		});
		Route::group(['prefix' => 'usertest'],function()
		{						
			return "Hello World";					
				
		});
		
		Route::group(['prefix' => 'userdb'],function()
		{
				// /api/user/
				//Route::get('{loginname}',['uses' => 'UserController@loginUser']);
				Route::get('',['uses' => 'UserController@allUsers']);
				Route::get('{id}',['uses' => 'UserController@getUsers']);
				Route::post('',['uses' => 'UserController@saveUsers']);
				Route::put('{id}',['uses' => 'UserController@updateUsers']);
				Route::delete('{id}',['uses' => 'UserController@deleteUsers']);			
		});
		*/
	});

	Route::group(['prefix' => 'core'],function()
	{		    	    	
		Route::group(['prefix' => 'data'],function()
		{	
		    Route::post('GetCompanyList',['as' => 'RGetList','uses' => 'CompanyController@func_CompanyAll']);	
		});			
	});
});

/*
Route::get('docs', function()
{
	return view::make('api.docs.index');
});

App::missing(function()
{
	return Redirect::to('docs');
});
*/

Route::get('/', function () {
    //return view('welcome');
    return 'Enjoy the silence...';
});
