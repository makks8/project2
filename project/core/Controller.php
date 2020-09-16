<?php

namespace core;

define('modelPath', '../models/');
define('viewPath', '../views/');

class Controller
{
    function getModel($model)
    {
        $model = modelPath . $model;
        return new $model;
    }

    function renderView($view, $data = [])
    {
        $path = viewPath . $view . '.php';
        if (file_exists($path)) {
            require_once $path;
        }
    }

}