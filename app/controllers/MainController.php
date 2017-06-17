<?php
namespace app\controllers;
use sys\http\Request;
use sys\http\Controller;
use app\models\User;

class MainController extends Controller
{
	public function index(Request $req){
//		$name = $req->input("name");
//        User::create(["name"=>"hoge!!!", "password" => "!!!!AA"]);
//        echo("hoge");
        return $this->response_json(["hoge"=>"hoge"]);
	}
	public function hoge($req){
		echo "疎通確認成功!!";
	}
}
