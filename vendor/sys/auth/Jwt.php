<?php
namespace sys\auth;
use sys\http\Request;

/**
 * Created by PhpStorm.
 * User: taiki
 * Date: 2017/06/18
 * Time: 11:34
 */
class Jwt
{
    private $header;
    public function __construct()
    {
        $this->header = $this->array_to_base64(["alg"=>"SH256", "typ"=>"JWT"]);
        $this->req = Request::getInstance();
    }

    public function getToken($userId){
        $payload = $this->array_to_base64(["sub"=>time(), "id"=>$userId]);
        $token = $this->header . "." . $payload;
        return $token .".". base64_encode(hash_hmac('sha256', $token, $this->req->env("JWT_KEY"), true));
    }
    public function check_token($token){
        $token = explode(".", $token);
        $hash = base64_encode(hash_hmac('sha256', $token[0].".".$token[1], $this->req->env("JWT_KEY"), true));
        if (!($token[2]==$hash)){
            return "tokenが不正です。";
        }
        $payload = $this->base64_to_array($token[1]);
//        var_dump($payload);
        if ($this->check_expiration($payload->sub)){
            return "有効期限が過ぎています";
        }
        return false;

    }
    //有効期限が過ぎていたらtrueを返す
    private function check_expiration($date){
        return time() >= $date + $this->req->env("JWT_EXPIRATION");
    }
    private function array_to_base64($array){
        return base64_encode(json_encode($array));
    }
    private function base64_to_array($string){
        return json_decode(base64_decode($string));
    }
}