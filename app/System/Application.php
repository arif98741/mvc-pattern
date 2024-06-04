<?php

namespace App\System;

/*
 * This is main class of mvc that handles and load
 */

use App\System\Exception\MethodNotFoundException;
use App\System\exception\MvcException;
use App\System\Http\Request;
use Exception;
use ReflectionMethod;
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

    /**
     * @throws Exception
     */
    public function run()
    {
        $this->initialize();
        $this->handleRequest();
    }

    /**
     * @throws Exception
     */
    private function initialize(): void
    {
        $controller = new Controller();
        try {
            $controller->config('environment');
            $controller->config('database');
        } catch (\Throwable $e) {
            $this->handleException($e);
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

        // Ignition::make()->register();
        //throw new \RuntimeException($exception);
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
     * Parse Url params
     * @return false|string[]
     */
    private function parseUrl()
    {
        if (isset($_GET['url'])) {

            $url = filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL);
            $tempHomeUrlChecking = explode('/', $url);
            if (count($tempHomeUrlChecking) == 1 && $tempHomeUrlChecking[0] == 'home') {
                return [
                    'home',
                    'index'
                ];
            }
            return explode('/', $url);
        }

        return [
            'home',
            'index'
        ];
    }

    /**
     * @throws MethodNotFoundException
     * @throws Exception
     */
    private function callMethod($method, $url)
    {
        try {

            if (!method_exists($this->controller, $method)) {
                throw new MethodNotFoundException("Method $method undefined from controller " . $this->getClassName());
            }
        } catch (Exception $exception) {
            $this->handleException($exception);
        }

        unset($url[1]);
        $this->method = $method;
        $this->params = $url ? array_values($url) : [];

        try {

            $reflectionMethod = new ReflectionMethod($this->controller, $this->method);
            $parameters = $reflectionMethod->getParameters();

            $passRequest = false;
            if (!empty($parameters)) {
                $firstParameter = $parameters[0]; // Assuming first parameter
                $type = $firstParameter->getType();
                if ($type !== null && !$type->isBuiltin() && $type->getName() === Request::class) {
                    $passRequest = true;
                }
            }

            // If typehint class(App\System\Http\Request) exists in the first param, pass new Request as the second param
            if ($passRequest) {
                $reflectionMethod->invoke(new $this->controller, new Request(), ...$this->params);
            } else {
                // Otherwise, pass only the params
                $reflectionMethod->invoke(new $this->controller, ...$this->params);
            }

        } catch (\Throwable  $exception) {
            $this->handleException($exception);
        }
    }

    private function getClassName(): string
    {
        return get_class((object)$this->controller);
    }
}
