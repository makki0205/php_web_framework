<?php
/**
 * Created by PhpStorm.
 * User: taiki
 * Date: 2017/06/18
 * Time: 22:59
 */

$test_user_name = "testuser";
$test_user_password = "testpass";

//test user 作成
$ch = curl_init();
curl_setopt_array($ch, [
    CURLOPT_URL => 'http://localhost:9000/signup',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => http_build_query(['name' => $test_user_name, 'password' => $test_user_password]),
]);

//JWT token 取得
$response = curl_exec($ch);
echo $response;
curl_close($ch);

//test user 作成
$ch = curl_init();
curl_setopt_array($ch, [
    CURLOPT_URL => 'http://localhost:9000/signin',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => http_build_query(['name' => $test_user_name, 'password' => $test_user_password]),
]);

$response = curl_exec($ch);
echo $response;
$json = json_decode($response);
var_dump($json->token);
$token = $json->token;
curl_close($ch);

// 認証が必要なページヘのアクセス
$ch = curl_init();
curl_setopt_array($ch, [
    CURLOPT_URL => 'http://localhost:9000?token='. $token,
    CURLOPT_RETURNTRANSFER => true,
]);
$response = curl_exec($ch);
echo $response;
curl_close($ch);
