<?php

namespace core;


define('controllerPath', '\controllers\\');

class Model extends ActiveRecord
{

    function controller($controller)
    {
        $controller = controllerPath . $controller;
        return new $controller;
    }

}