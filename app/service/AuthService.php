<?php
/**
 * Created by PhpStorm.
 * User: taiki
 * Date: 2017/06/18
 * Time: 14:47
 */

namespace app\service;


use sys\auth\Jwt;

class AuthService extends BaseService
{
    private $jwt;
    public function __construct(){
        $this->jwt = new Jwt();
    }

    public function check_token($token){
        return $this->jwt->check_token($token);
    }
}