<?php
return [
	'get/'=>'MainController@index@JwtMiddleware',
	'post/signin'=>'UserController@get_token',
    'post/signup'=>'UserController@create_user',
];