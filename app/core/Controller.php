<?php


class Controller
{
    /**
     * Store Database Object
     * @var
     */
    protected $connection;

    /**
     * Model Handler
     * @param $model
     * @return mixed
     */
    public function model($model)
    {
        require_once '../app/models/' . $model . '.php';
        return new $model();
    }

    /**
     * Load View File
     * @param $view
     * @param array $data
     */
    public function view($view, $data = [])
    {
        require_once '../app/views/' . $view . '.php';
    }

    /**
     * This will load library
     * @param string $library
     * @return mixed
     */
    public function load($library = '')
    {
        switch ($library) {
            case 'database':
                require_once 'libraries/' . $library . '.php';
                return new $library();
        }
    }
}