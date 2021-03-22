<?php

/*
 * This is main class of mvc that handles and load
 */

class App
{
    /**
     * @var string
     */
    protected $controller = 'home';

    /**
     * @var string
     */
    protected $method = 'index';

    /**
     * @var array
     */
    protected $params = [];

    /**
     * App constructor.
     */
    public function __construct()
    {
        $url = $this->parseUrl();
        if (file_exists('../app/controllers/' . $url[0] . '.php')) {
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

        $this->params = $url ? array_values($url) : [];

        call_user_func_array([$this->controller, $this->method], $this->params);

    }

    /**
     * Parse Url params
     * @return false|string[]
     */
    private function parseUrl()
    {
        if (isset($_GET['url'])) {

            $url = filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL);
            return explode('/', $url);

        }
    }
}