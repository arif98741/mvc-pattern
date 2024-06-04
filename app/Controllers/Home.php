<?php

namespace App\Controllers;


use app\System\Controller;
use App\System\Exception\ViewNotFoundException;
use App\System\Http\Request;

class Home extends Controller
{
    /**
     * Index Method for showing homepage and base
     * @param Request $request
     * @throws ViewNotFoundException
     */
    public function index(Request $request)
    {
        $hello = [
            'data1' => 'Test',
            'data2' => 100,
        ];

        $this->view('welcome', compact('hello'));
    }

}
