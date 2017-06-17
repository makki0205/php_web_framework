<?php
use sys\http\Request;
use Illuminate\Database\Capsule\Manager as Capsule;
use sys\http\Router;

require_once DOCUMENT_ROOT . '/vendor/sys/db/dbconfig.php';
$router = new Router();
$msg = $router->run();
echo ($msg);

//
////データ取り出し
//$uri = $_SERVER["REQUEST_URI"];
//$uri = strtok($uri, '?');
//$method = strtolower($_SERVER["REQUEST_METHOD"]);
//$requestValue = $method . $uri;
//$routs = require_once DOCUMENT_ROOT . '/app/routs/routs.php';
////uriチェック
//if (!isset($routs[$requestValue])) {
//    http_response_code(404);
//    echo "404";
//	exit;
//}
////例）データ整形
//$controller = explode('@',$routs[$requestValue]);
//$controller[0] = "\\app\\controllers\\" . $controller[0];
//
//// クラス チェック
//if (!class_exists($controller[0])) {
//	echo $controller[0] . " : Class not found";
//	exit;
//}
//$con = new $controller[0];
//// メソッド チェック
//if (!method_exists($con,$controller[1]) ) {
//	echo $controller[0] ." : : ". $controller[1] ."() : Method not found";
//	exit;
//
//}
//
//
//$req = Request::getInstance();
//$capsule = new Capsule;
//
//$capsule->addConnection(array(
//    'driver'    => 'mysql',
//    'host'      => $req->env("DATABASE_HOST"),
//    'database'  => $req->env("DATABASE_NAME"),
//    'username'  => $req->env("DATABASE_USER"),
//    'password'  => $req->env("DATABASE_PASSWORD"),
//    'charset'   => 'utf8',
//    'collation' => 'utf8_unicode_ci',
//    'prefix'    => ''
//));
//$capsule->bootEloquent();
//
//$con->$controller[1]($req);
