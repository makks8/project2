<?php

namespace controllers;

use core\Controller;

class MainController extends Controller
{
    public function __construct()
    {
    }

    function index()
    {
        $this->renderView('main');
    }

}