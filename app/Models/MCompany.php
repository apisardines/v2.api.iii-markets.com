<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Input;

class MCompany extends Model
{

    public static function func_getCompanyList($latitude, $longtitude, $radius)
    {
        //dd($username);
        $sql = "SELECT * FROM func_app_getobjarround($latitude,$longtitude,$radius)";
        //dd($sql);
        $data =  DB::select($sql,[]);
        //dd($sql);
        return $data;     
    }    
}
