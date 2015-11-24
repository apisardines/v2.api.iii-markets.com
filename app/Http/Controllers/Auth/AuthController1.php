<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Models;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class AuthController1 extends Controller
{
    protected $user1;
    protected $auth1;

    public function __construct(Guard $auth1, User1 $user1)
    {
        $this->user1 = $user1; 
        $this->auth1 = $auth1;
 
        $this->middleware('guest', ['except' => ['getLogout']]); 
    }

    public function getRegister()
    {
        return view('auth.register');
    }

    public function postRegister(RegisterRequest $request)
    {
        //code for registering a user goes here.
        $this->auth->login($this->user); 
        return redirect('/dash-board'); 
    }

    public function getLogin()
    {
        return view('auth.login');
    }

    public function postLogin(LoginRequest $request)
    {
        if ($this->auth->attempt($request->only('email', 'password')))
        {
            return redirect('/dash-board');
        }
 
        return redirect('/login')->withErrors([
            'email' => 'The credentials you entered did not match our records. Try again?',
        ]);
    }

    public function getLogout()
    {
        $this->auth->logout();
 
        return redirect('/');
    }

}
