<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Input;

class Users extends Model
{
    protected $table = 'UserList';
    protected  $filltable = ['LoginName','Password'];
    protected $hidden = array('Password');
    public $timestamps = false;

    public static function func_Login($username, $password)
    {
        //dd($username);
        $sql = "SELECT * FROM func_login('$username','$password')";
        $data =  DB::select($sql,[]);
        //dd($sql);
        return $data;     
    }


    public static function func_Insert_New($emailaddress,$phonenumber,$registermethod
    	,$password, $provider, $seekers, $referees, $lastpagedisplay)
    {
        //dd($username);

        $sql = "SELECT * FROM func_insert_userlist_new('$emailaddress','$phonenumber',$registermethod,'$password',$provider,$seekers,$referees,$lastpagedisplay)";
        //dd($sql);
        //return $sql;

        $data =  DB::select($sql,[]);
        //dd($sql);
        return $data;     
    }
    

    public static function func_Insert($username, $password, $emailaddress
        ,$phonenumber, $provider, $seekers, $referees, $lastpagedisplay)
    {
        //dd($username);

        $sql = "SELECT * FROM func_insert_userlist('$username','$emailaddress','$password','$phonenumber',$provider,$seekers,$referees,$lastpagedisplay)";
        //dd($sql);
        //return $sql;

        $data =  DB::select($sql,[]);
        //dd($sql);
        return $data;     
    }  

    public static function func_GetResultMessage($code,$languageID)
    {
        //dd($username);

        $sql = "SELECT * FROM func_getresultoutput('$code',$languageID)";
        //dd($sql);
        //return $sql;

        $data =  DB::select($sql,[]);
        //dd($sql);
        return $data;     
    }  

    public static function func_Update($id, $username, $password, $emailaddress
        ,$phonenumber, $provider, $seekers, $referees, $lastpagedisplay)
    {
        //dd($username);

        $sql = "SELECT * FROM func_update_userlist($id,'$username','$emailaddress','$password','$phonenumber',$provider,$seekers,$referees,$lastpagedisplay)";
        //dd($sql);
        //return $sql;

        $data =  DB::select($sql,[]);
        //dd($sql);
        return $data;     
    }    

    public static function func_GetAll()
    {
        $sql = "SELECT * FROM func_getAllUsers()";
        $data = DB::select($sql,[]);
        return $data;        
    }

    public static function func_SaveUser()
    {
        $input = Input::all();
        dd($input);
        return $input;
    }

    public static function func_getUsers($id)
    {
        $sql = "SELECT * FROM func_getuserbyid('$id')";
        $data = DB::select($sql,[]);
        //$user = new Users();
        //$user->id = $data[0]['ID'];
        //$user->username = $data[0]['UserName'];
        //$user->password = $data[0]['Password'];
        
        return $data;
    }    
}
