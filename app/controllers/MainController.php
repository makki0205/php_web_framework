<?php
namespace app\controllers;
use sys\http\Request;
use app\models\User;

class MainController
{
	public function index(Request $req){
		$name = $req->input("name");
        User::create(["name"=>"hoge!!!", "password" => "!!!!AA"]);
        echo("hoge");
	}
	public function hoge($req){
		echo "疎通確認成功!!";
	}
}
