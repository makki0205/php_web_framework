<?php
namespace app\service;
use app\models\User;
use sys\auth\Jwt;

/**
 * Created by PhpStorm.
 * User: taiki
 * Date: 2017/06/18
 * Time: 4:19
 */
class UserService extends BaseService
{
    public function check_user_name($user_name){
        return User::where('name',$user_name)->first();
    }
    public function create_user($user){
        User::create($user);

    }
    public function get_token($user_id){
        $jwt = new Jwt();
        return $jwt->getToken($user_id);
    }
    public function check_user($user){
        $user = User::where('name', $user['name'])->where('password',$user['password'])->first();
        if ($user){
            return $user->id;
        }
        return null;
    }
}