<?php
namespace sys\http;

class Request
{
    private static $instance;

    private function __construct()
    {
        $this->env_list = parse_ini_file(DOCUMENT_ROOT."/config.ini");
    }
    function input($input_key)
    {
        if (isset($_GET[$input_key])) {
            return $_GET[$input_key];
        }
        if (isset($_POST[$input_key])) {
            return $_POST[$input_key];
        }
        return null;
    }
    function env($env_key)
    {
        if(isset($this->env_list[$env_key])){
            return $this->env_list[$env_key];
        }
        return null;
    }
    public static function getInstance()
    {
        static $instance = null;
        if (null === $instance) {
            $instance = new static();
        }
        return $instance;
    }

}
