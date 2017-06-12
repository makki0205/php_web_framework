<?php
namespace myapp\controllers;
use sys\http\Request;


class MainController
{
	public function index(Request $req){
		$name = $req->input("name");
		echo $name;
		echo $req->env("DATABASE_NAME");

	}
	public function hoge($req){
		echo "疎通確認成功!!";
	}
}
