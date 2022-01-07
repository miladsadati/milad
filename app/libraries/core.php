<?php

class core
{
    protected $controller = 'Pages';
    protected $method = 'index';
    protected $params = [];

    public function __construct()
    {
        // make url for controller //
        $url = $this->url();
        if (file_exists('../app/controllers/'. ucwords($url[0]).'.php')) {
            $this->controller = ucwords($url[0]);
            unset($url[0]);
        }
        require_once '../app/controllers/'. $this->controller.'.php';
        $this->controller = new $this->controller;

        //make url for method
        if (isset($url[1])) {
            if (method_exists($this->controller,$url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }
        //make params
        if ($this->params = $url) {
            array_values($url);
        } else {
            $this->params = [];
        }
        call_user_func_array([$this->controller, $this->method] ,$this->params);
    }

    //public function url///////////////////
    public function url()
    {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
        {

        }
    }
}