<?php
namespace myapp\controllers;



class MainController
{
	public function index($req){
		$name = $req->input("name");
		echo $name;
		echo $req->env("HOST");

	}
	public function hoge($req){
		echo "疎通確認成功!!";
	}
}
