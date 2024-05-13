<?php

namespace App\System;

use App\System\exception\MvcException;
use App\System\Helpers\AppHelper;

class Controller
{
    protected $params;

    /**
     * @return mixed
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * Model Handler
     * @param $model
     * @return mixed
     */
    public function model($model)
    {
        try {
            if (class_exists('\\App\Models\\' . $model)) {
                $model = "\\App\\Models\\$model";
                return new $model;
            }

            throw new MvcException("Model '$model' does not exist");

        } catch (MvcException $exception) {

            echo '<pre>';
            print_r($exception->showException([
                debug_print_backtrace()
            ]));
        }
    }

    /**
     * Load View File
     * @param $view
     * @param array $data
     */
    public function view($view, $data = [])
    {
        try {

            if (file_exists('../App/views/' . $view . '.php')) {
                require_once '../App/views/' . $view . '.php';
            } else {
                throw new MvcException("Requested view '$view' does not exist");
            }
        } catch (MvcException $exception) {

            echo '<pre>';
            print_r($exception->showException([
                debug_print_backtrace()
            ]));

        }
    }

    /**
     * This will load library
     * @param string $library
     * @return mixed
     */
    public function load(string $library = '')
    {
        try {
            switch ($library) {
                case 'database':
                    $library = "\\App\\System\\Libraries\\$library";
                    return new $library();
                case 'form':
                    $library = "\\App\\System\\Validator\\$library";
                    return new $library();
                default:
                    throw new MvcException("library '$library' does not exist");
            }
        } catch (MvcException $exception) {
            throw new \RuntimeException($exception);
        }
    }

    /**
     * This will load Helpers
     * @param string $helper
     * @return mixed
     */
    public function helpers($helper = '')
    {
        try {
            $helper = "\\App\\System\\Helpers\\$helper";
            if (class_exists($helper)) {
                return new $helper;
            } else {
                throw new MvcException("library '$helper' does not exist");
            }

        } catch (MvcException $exception) {

            echo '<pre>';
            print_r($exception->showException([
                debug_print_backtrace()
            ]));

        }
    }


    /**
     * @param $config
     * @throws \Exception
     */
    public function config($config)
    {
        $configurationFilePath = AppHelper::getAppPath() . '/../../../config/' . $config . '.php';

        try {

            if (file_exists($configurationFilePath)) {
                require_once $configurationFilePath;

            } else {

                throw new MvcException("config file '$config' does not exist");
            }

        } catch (MvcException $exception) {
            throw new \Exception($exception);

        }
    }


}
