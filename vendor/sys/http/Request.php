<?php
namespace sys\http;

class Request
{
    private static $instance;
    private $data = array();
    private function __construct()
    {

        $this->env_list = parse_ini_file(DOCUMENT_ROOT."/config.ini");
    }
    public function set_data($data){
        $this->data += $data;
    }
    public function input($input_key)
    {
        if (isset($this->data[$input_key])){
            return $this->data[$input_key];
        }
        if (isset($_GET[$input_key])) {
            return $_GET[$input_key];
        }
        if (isset($_POST[$input_key])) {
            return $_POST[$input_key];
        }
        return null;
    }
    public function inputs($input_keys)
    {
        $list = array();
        foreach ($input_keys as $key){
            $list[$key] = $this->input($key);
        }
        return $list;
    }
    public function env($env_key)
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
