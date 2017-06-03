<?php
use myapp\controllers;
use sys\http\Request;
//データ取り出し
$uri = $_SERVER["REQUEST_URI"];
$uri = strtok($uri, '?');
$method = strtolower($_SERVER["REQUEST_METHOD"]);
$requestValue = $method . $uri;
$routs = require_once DOCUMENT_ROOT . '/src/routs/routs.php';
//uriチェック
if (!isset($routs[$requestValue])) {
	echo "404";
	exit;
}
//例）データ整形
$controller = explode('@',$routs[$requestValue]);
$controller[0] = "\\myapp\\controllers\\" . $controller[0];
// コントローラ チェック
if (!class_exists($controller[0])) {
	echo $controller[0] . " : Class not found";
	exit;
}
$con = new $controller[0];
// メソッドテスト
if (!method_exists($con,$controller[1]) ) {
	echo $controller[0] ." : : ". $controller[1] ."() : Method not found";
	exit;

}

$req = Request::getInstance();
ORM::configure('mysql:host=' .$req->env('HOST'). ';dbname=' .$req->env('HOST'));
ORM::configure('username', $req->env('HOST'));
ORM::configure('password', $req->env('PASSWORD'));

$con->$controller[1]($req);
