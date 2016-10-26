<?php
use app\Router as Router;
$app = new Router();


$app->get("/","index");
$app->post("/store","store");
$app->post("/updata","updata");
$app->post("/delete","delete");



$app->post("/users","getToken");
