<?php
/**
 * Created by PhpStorm.
 * User: taiki
 * Date: 2017/06/18
 * Time: 4:35
 */

namespace app\service;


class BaseService
{
    public function err($message){
        return ["err"=>$message];
    }
    public function success(){
        return ["err"=>null];
    }
}