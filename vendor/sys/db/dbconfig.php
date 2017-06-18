<?php
/**
 * Created by PhpStorm.
 * User: taiki
 * Date: 2017/06/13
 * Time: 19:39
 */
use Illuminate\Database\Capsule\Manager as Capsule;
use sys\http\Request;


$req = Request::getInstance();
$capsule = new Capsule;

$capsule->addConnection(array(
    'driver'    => 'mysql',
    'host'      => $req->env("DATABASE_HOST"),
    'database'  => $req->env("DATABASE_NAME"),
    'username'  => $req->env("DATABASE_USER"),
    'password'  => $req->env("DATABASE_PASSWORD"),
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => ''
));
$capsule->bootEloquent();