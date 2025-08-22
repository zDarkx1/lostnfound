<?php

class App
{
    //default route
    protected $controller = 'LandingPage';
    protected $method = 'index';
    protected $params = [];

    public function __construct()
    {
        $url = $this->ParseURL();
        if ($url !== null && file_exists('../app/controllers/' . $url[0] . '.php')) {
            $this->controller = $url[0];
            unset($url[0]);
        }
        require_once '../app/controllers/' . $this->controller . '.php';
        $this->controller = new $this->controller;

        if (isset($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }
        if (!empty($url)) {
            $this->params = array_values($url);
        }

        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    public function ParseURL()
    {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/'); //trim last delimiter
            $url = filter_var($url, FILTER_SANITIZE_URL); //sanitizing
            $url = explode('/', $url); //unpacking url
            return $url;
        }
    }
}
