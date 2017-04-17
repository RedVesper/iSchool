<?php

namespace App\Http\Controllers;

use App\Log;
use Illuminate\Http\Request;

use App\Http\Requests;

class Tool extends Controller
{
    //
    public static function getDateTime()
    {
        return date('Y-m-d H:i:s');
    }

    public static function getDate()
    {
        return date('Y-m-d');
    }

    public static function get_user_id()
    {
        if(self::isLogin()){
            return \Auth::user()->id;
        }else{
            return 250;
        }

    }

    public static function get_user_name()
    {
        if(self::isLogin()){
            return \Auth::user()->name;
        }else{
            return '游客';
        }

    }

    //获取用户级别
    public static function getLevel()
    {
        if(!self::isLogin()){
            return 2;
        }else{
            if(in_array(\Auth::user()->id,[1,2]))
                return 1;
            else
                return 2;
        }
    }

    public static function isLogin()
    {
        return \Auth::check();
    }

    public static function returnMsg($status,$msg)
    {
        return response()->json(array(
            'status' => $status,
            'msg' => $msg
        ));
    }

    public static function writeLog($content)
    {
        $log = new Log();
        $log->add_user_id = self::get_user_id();
        $log->content = $content;
        $log->save();
    }
}
