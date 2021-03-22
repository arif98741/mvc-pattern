<?php


class Home extends Controller
{
    /**
     * Index Method for showing homepage and base
     * @param $name
     */
    public function index($name)
    {
        $user = $this->model('user');
        $user->name = $name;
        $this->view('home/index', ['user' => $name]);
        $connection = $this->load('database');
        var_dump($connection::instance);
    }
}