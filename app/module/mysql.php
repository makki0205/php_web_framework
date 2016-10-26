<?php
namespace Database;
use PDO;

class Model{
	private $host;
	private $user;
	private $password;
	function __construct(){
		$host = '127.0.0.1';
		$user = 'taiki';
		$password = 'hoge';
		try{
			$dbh = new PDO('mysql:host='.$host.';dbname=phptest',$user,$password);
			foreach ($dbh->query('SELECT * from users') as $row) {
			}
			$dbh = null;
		}catch(PDOException $e){
			print "エラー!: " . $e->getMessage() . "<br/>";
    		die();
		}
		$this->host = $host;
		$this->user = $user;
		$this->password = $password;
	}
	//テーブルの中身を返すメソッド
	public function getall($tabel){
		$hoge = $this->query('SELECT  * from '.$tabel);
		return $hoge;
	}
	// select文を実行するメソッド
	public function select($query){
		$data = array();
		try{
			$dbh = new PDO('mysql:host='.$this->host.';dbname=phptest',$this->user,$this->password);
			$stmt = $dbh->prepare($query);
			$stmt->execute();
			$data = $stmt->fetchAll();
			$dbh = null;
		}catch(PDOException $e){
			print "エラー!: " . $e->getMessage() . "<br/>";
    		die();
    		return null;
		}
		return $data;
	}
	
	// update文を実行するメソッド
	public function update($query){
		try{
			$dbh = new PDO('mysql:host='.$this->host.';dbname=phptest',$this->user,$this->password);
			$check = $dbh->query($query);
		}catch(PDOException $e){
			print "エラー!: " . $e->getMessage() . "<br/>";
    		die();
    		return null;
		}
	}
	public function insert($query){
		try{
			$dbh = new PDO('mysql:host='.$this->host.';dbname=phptest',$this->user,$this->password);
			$check = $dbh->query($query);
		}catch(PDOException $e){
			print "エラー!: " . $e->getMessage() . "<br/>";
    		die();
    		return null;
		}
	}
	public function delete($query){
		try{
			$dbh = new PDO('mysql:host='.$this->host.';dbname=phptest',$this->user,$this->password);
			$check = $dbh->query($query);
		}catch(PDOException $e){
			print "エラー!: " . $e->getMessage() . "<br/>";
    		die();
    		return null;
		}
	}






}
