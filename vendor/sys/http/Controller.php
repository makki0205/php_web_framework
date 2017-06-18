<?php
/**
 * Created by PhpStorm.
 * User: taiki
 * Date: 2017/06/16
 * Time: 20:31
 */

namespace sys\http;


class Controller
{
    protected function response_json($data, $code=200){
        http_response_code($code);
        return json_encode($data);
    }
}