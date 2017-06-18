<?php
namespace app\middleware;
use app\service\AuthService;
use sys\http\Middleware;
use sys\http\Request;

/**
 * Created by PhpStorm.
 * User: taiki
 * Date: 2017/06/18
 * Time: 19:10
 */
class JwtMiddleware extends Middleware
{
    private $auth;
    public function __construct(){
        $this->auth = new AuthService();
    }

    public function run(Request $req)
    {
        $err = $this->auth->check_token($req->input('token'));
        if ($err) {
            return $this->response_json($this->auth->err($err), 400);
        }
        $user_id = $this->auth->get_user_id($req->input('token'));
        $req->set_data(["user_id" => $user_id]);
        return null;
    }
}