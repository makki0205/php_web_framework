<?php
use sys\http\Request;
use Illuminate\Database\Capsule\Manager as Capsule;
use sys\http\Router;

require_once DOCUMENT_ROOT . '/vendor/sys/db/dbconfig.php';
$router = new Router();
$msg = $router->run();

echo ($msg);
