<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class login_model extends Model
{
    use HasFactory;

    // Login Check
    public function login_check_model($data)
    {
        $data=(object)$data;
        $ret=DB::table('admin')->where(array('email'=>$data->email,'password'=>md5($data->password)))->get();
        return $ret;
    }

    

}
