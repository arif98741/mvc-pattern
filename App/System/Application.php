<?php

namespace App\System;

/*
 * This is main class of mvc that handles and load
 */

use App\System\Exception\MethodNotFoundException;
use App\System\exception\MvcException;
use ArgumentCountError;
use Exception;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Run as WhoopsRun;


class Application
{
    /**
     * @var string
     */
    //protected $controller = 'home';
    protected $controller;

    /**
     * @var string
     */
    // protected $method = 'index';
    private string $method;

    /**
     * @var array
     */
    private array $params = [];

    public function __construct()
    {
        $this->initialize();
        $this->handleRequest();
    }

    private function initialize()
    {
        $controller = new Controller();
        $controller->config('environment');
        $controller->config('database');
    }

    private function handleRequest()
    {
        try {
            $url = $this->parseUrl();
            $className = '\\App\\Controllers\\' . $url[0];

            if (!class_exists($className)) {
                throw new MvcException('Class ' . $url[0] . ' Not found');
            }

            $this->controller = new $className;
            unset($url[0]);

            if (isset($url[1])) {

                $this->callMethod($url[1], $url);
            }
        } catch (MvcException $exception) {
            $this->handleException($exception);
        } catch (MethodNotFoundException|Exception $e) {
            $this->handleException($e);
        }
    }


    /**
     * @throws MethodNotFoundException
     * @throws Exception
     */
    private function callMethod($method, $url)
    {
        try {

            if (!method_exists($this->controller, $method)) {
                throw new MethodNotFoundException("Method $method not found from " . $this->getClassName());
            }
        } catch (Exception $exception) {
            $this->handleException($exception);
        }

        unset($url[1]);
        $this->method = $method;
        $this->params = $url ? array_values($url) : [];

        try {
            call_user_func_array([$this->controller, $this->method], $this->params);
        } catch (\Throwable  $exception) {
            $this->handleException($exception);
        }
    }

    /**
     * @throws Exception
     */
    private function handleException($exception)
    {
        $whoops = new WhoopsRun;
        $whoops->pushHandler(new PrettyPageHandler);
        $whoops->register();
        $whoops->handleException($exception);

        //Ignition::make()->register();
        //throw new \RuntimeException($exception);
    }


    private function getClassName(): string
    {
        return get_class((object)$this->controller);
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

        return [
            'home',
            'index'
        ];
    }
}
