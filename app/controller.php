<?php
namespace app;
use database\Model as Model;
class controller{
	// tokenをCheckする
	private function tokenCheck(){
		$model = new Model;
		$name = $model->select("select name from users where token=\"".$_POST['token']."\"");
		if (!$name) {
			echo json_encode(["errMessage"=>"token wrong"]);
			exit();
		}
		return $name[0]['name'];
	}
	// 記事の取得
	public function index(){
		$model = new Model;
		if (isset($_GET['id'])) {
			$data = $model->select("select * from posts where id=".$_GET['id']);
			if ($data) {
				echo json_encode(array_merge($data,array("errMessage"=>"","")));
			}else{
				echo json_encode(["errMessage"=>"id is not found"]);
			}
		}else{
			$data = $model->select("select * from posts ");
			echo json_encode(array_merge($data,array("errMessage"=>"")));
		}
	}
	// 記事の追加
	public function store(){
		$this->tokenCheck();
		$model =new Model;
		if (!isset($_POST['title'])) {echo json_encode(["errMessage"=>"title wrong"]);exit;}
		if (!isset($_POST['body']))  {echo json_encode(["errMessage"=>"body wrong"]);exit;}
		$check = $model->insert("insert into posts (title,body) values('".$_POST['title']."','".$_POST['body']."')");
		echo json_encode(["errMessage"=>$check]);
	}
	// 記事の削除
	public function delete(){
		$this->tokenCheck();
		$model =new Model;
		if (!isset($_POST['id'])) {echo json_encode(["errMessage"=>"id wrong"]);exit;}
		$check = $model->delete("delete from posts where id=".$_POST['id']);
		echo json_encode(["errMessage"=>$check]);
	}
	//記事の更新
	public function updata(){
		$this->tokenCheck();
		$model = new Model;
		if (!isset($_POST['id'])) {echo json_encode(["errMessage"=>"id wrong"]);exit;}
		if (isset($_POST['title'])) {
			echo "update posts set title=\"".$_POST['title']."\" where id=".$_POST['id'];
			$check = $model->update("update posts set title=\"".$_POST['title']."\" where id=".$_POST['id']);
			echo $check;
		}
		if (isset($_POST['body'])) {
			echo "update posts set body=\"".$_POST['body']."\" where id=".$_POST['id'];
			$check = $model->update("update posts set body=\"".$_POST['body']."\" where id=".$_POST['id']);
			echo $check;
		}
		$check = $model->update("update posts set");
	}
	// トークンの取得
	public function getToken(){
		$model = new Model;
		$password = $model->select( "select password from users where name=\"".$_POST['name']."\"" );
		if ($password[0][0]== $_POST['password']) {
			$token = ["time"=>time(),"name"=>$_POST['name']];
			$token = base64_encode(json_encode($token));
			$model->update("update users set token=\"".$token."\" where name=\"".$_POST['name']."\"");
			echo json_encode(["errMessage"=>"","token"=>$token]);
		}else{
			echo json_encode(["errMessage"=>"name is not found"]);
		}
	}
}

