<?php
return [
	'get/'=>'MainController@index',
	'post/hoge'=>'MainController@hoge',
	'post/signin'=>'UserController@get_token',
    'post/signup'=>'UserController@create_user',
];