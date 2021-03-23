<?php

namespace app\controllers;


use app\core\Controller;

class Home extends Controller
{
    /**
     * Index Method for showing homepage and base
     */
    public function index()
    {
        $user = $this->model('user');
        $user->getUsers();
        exit;



        $name = 'Jhon';
        $this->view('home/index', ['user' => $name]);
        var_dump(get_included_files());
    }

    public function contact()
    {
        echo 'I am from contact';
    }

}