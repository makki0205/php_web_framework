<?php
namespace app;
require_once($_SERVER['DOCUMENT_ROOT']."/app/controller.php");
require_once($_SERVER['DOCUMENT_ROOT']."/app/module/mysql.php");

class Router{
	private $uri;	//URI
	private $method;	//メソッド
	private $gets = array(); // getURI
	private $posts = array();// postURI
	private $puts = array(); // putURI
	private $deletes = array();// deleteURI
	private $patchs = array();	// patchURI

	function __construct(){
		$this->uri = $_SERVER["REQUEST_URI"];
		$this->uri = strtok($this->uri, '?');
		$this->method = $_SERVER["REQUEST_METHOD"];
	}
	public function forward(){
		switch ($this->method) {
			case 'GET':
				$this->getAdmin();
				break;
			case 'POST':
				$this->postAdimin();
				break;
			case 'PUT':
				$this->putAdimin();
				break;
			case 'DELETE':
				$this->deleteAdimin();
			break;
			case 'PATCH':
				$this->patchAdimin();
				break;
			default:
				echo "非対応のメソッドです";
				break;
		}
	}
	//get
	private function getAdmin(){
		if ($this->gets[$this->uri]) {
			$class = new controller();
			$method = array( $class, $this->gets[$this->uri]);
			call_user_func($method);
		}else{
			echo $this->uri;
			echo "404";
		}
	}
	public function get($setUri , $functionName){
		$this->gets[$setUri] = $functionName;
	}
	//post
	private function postAdimin(){
		if ($this->posts[$this->uri]) {
			$class = new controller();
			$method = array( $class, $this->posts[$this->uri]);
			call_user_func($method);
		}else{
			echo $this->uri." is ";
			echo "404";
		}
	}
	public function post($setUri , $functionName){
		$this->posts[$setUri] = $functionName;
	}

	//put
	private function putAdimin(){
		if ($this->puts[$this->uri]) {
			$class = new cntroller();
			$method = array( $classco, $this->puts[$this->uri]);
			call_user_func($method);
		}else{
			echo $this->uri;
			echo "404";
		}
	}
	public function put($setUri , $functionName){
		$this->puts[$setUri] = $functionName;
	}

	//delete
	private function deleteAdimin(){
		if ($this->deletes[$this->uri]) {
			$class = new controller();
			$method = array( $class, $this->deletes[$this->uri]);
			call_user_func($method);
		}else{
			echo $this->uri;
			echo "404";
		}
	}
	public function delete($setUri , $functionName){
		$this->deletes[$setUri] = $functionName;
	}

	//patch
	private function patchAdimin(){
		if ($this->patchs[$this->uri]) {
			$class = new controller();
			$method = array( $class, $this->patchs[$this->uri]);
			call_user_func($method);
		}else{
			echo $this->uri;
			echo "404";
		}
	}
	public function patch($setUri , $functionName){
		$this->patchs[$setUri] = $functionName;
	}
}
require_once($_SERVER['DOCUMENT_ROOT']."/app/Router.php");
$app->forward();









