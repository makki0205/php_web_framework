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
    public function __construct()
    {
        $this->uri = $_SERVER["REQUEST_URI"];
        $this->uri = strtok($this->uri, '?');
        $this->method = strtolower($_SERVER["REQUEST_METHOD"]);
        $this->requestValue = $this->method . $this->uri;
        $this->routs = require_once DOCUMENT_ROOT . '/app/routs/routs.php';
        return $this->req = Request::getInstance();
    }

    public function run(){
        $this->uri_charck();
        $controller_name = $this->class_method_parse($this->routs[$this->requestValue]);
        $controller = $this->get_controller_instance($controller_name['class']);
        $this->method_check($controller, $controller_name["method"]);
        return $controller->$controller_name["method"]($this->req);
    }

    private function uri_charck(){
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
            "method" => $controller[1]
        ];
    }

    private function get_controller_instance($class_name){
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
}