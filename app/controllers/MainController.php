<?php
namespace app\controllers;
use app\models\User;
use sys\http\Request;
use sys\http\Controller;

class MainController extends Controller
{
    public function __construct(){
    }
    public function index(Request $req){
        $user_id = $req->input('user_id');
        $user = User::find($user_id)->first();
        return "hello ". $user->name;
	}
}
