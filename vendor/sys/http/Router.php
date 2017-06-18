<?php
/**
 * Created by PhpStorm.
 * User: taiki
 * Date: 2017/06/13
 * Time: 18:28
 */

namespace sys\http;


class Router
{
    private $app_path = "\\app\\controllers\\";
    private $middleware_path = "\\app\\middleware\\";
    public function __construct()
    {
        $this->uri = $_SERVER["REQUEST_URI"];
        $this->uri = strtok($this->uri, '?');
        $this->method = strtolower($_SERVER["REQUEST_METHOD"]);
        $this->requestValue = $this->method . $this->uri;
        $this->routs = require_once DOCUMENT_ROOT . '/app/routs/routs.php';
        $this->req = Request::getInstance();
    }

    public function run(){
        $this->uri_check();
        $controller_name = $this->class_method_parse($this->routs[$this->requestValue]);
        $controller = $this->get_class_instance($controller_name['class']);
        $this->method_check($controller, $controller_name["method"]);
        $err = $this->run_middleware($controller_name['middleware']);
        if ($err){
            return $err;
        }
        return $controller->$controller_name["method"]($this->req);
    }
    private function uri_check(){
        if (!isset($this->routs[$this->requestValue])) {
            http_response_code(404);
            echo "404";
            exit;
        }
    }

    private function class_method_parse($class_method){
        $controller = explode('@',$class_method);
        return [
            "class" => $this->app_path . $controller[0],
            "method" => $controller[1],
            "middleware"=> array_slice($controller, 2)
        ];
    }

    private function get_class_instance($class_name){
        if (!class_exists($class_name)) {
            echo $class_name . " : Class not found";
            exit;
        }
        return new $class_name;
    }

    private function method_check($instance, $method_name){
        if (!method_exists($instance,$method_name) ) {
            echo get_class($instance) ." : : ". $method_name ."() : Method not found";
            exit;
        }
    }

    private function run_middleware($middlewares){
        foreach ($middlewares as $middleware){
            $instance = $this->get_class_instance($this->middleware_path . $middleware);
            $err = $instance->run($this->req);
            if ($err){
                return $err;
            }
        }
        return null;
    }
}