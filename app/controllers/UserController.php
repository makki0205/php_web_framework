<?php
namespace app\controllers;
use app\service\UserService;
use sys\http\Controller;
use sys\http\Request;


class UserController extends Controller
{
    private $user = null;
    public function __construct(){
        $this->user = new UserService();
    }
    public function get_token(Request $req){
        $user_id = $this->user->check_user($req->inputs(["name", "password"]));
        if (!$user_id){
            return $this->response_json($this->user->err("ユーザまたはパスワードが違います"), 400);
        }
        return $this->response_json(["token"=>$this->user->get_token($user_id)]);
	}
	public function create_user(Request $req){
        if ($this->user->check_user_name($req->input('name'))){
            return $this->response_json($this->user->err("ユーザー名は現在使われています"), 400);
        }
        $this->user->create_user($req->inputs(['name', 'password']));
        return $this->response_json($this->user->success());
    }
}