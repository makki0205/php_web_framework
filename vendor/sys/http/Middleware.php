<?php
/**
 * Created by PhpStorm.
 * User: taiki
 * Date: 2017/06/18
 * Time: 19:44
 */

namespace sys\http;


class Middleware
{
    protected function response_json($data, $code=200){
        http_response_code($code);
        return json_encode($data);
    }
}