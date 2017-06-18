<?php
namespace app\controllers;
use sys\http\Request;
use sys\http\Controller;
use app\service\AuthService;

class MainController extends Controller
{
    private $auth;
    public function __construct(){
        $this->auth = new AuthService();
    }
    public function index(Request $req){
        $err = $this->auth->check_token($req->input('token'));
        if ($err){
            return $this->response_json($this->auth->err($err), 400);
        }
        return $this->response_json($this->auth->success());
	}
}
