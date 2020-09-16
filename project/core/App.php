<?php

namespace core;

use models\Client;

class App
{
    private $path = 'controllers\\';

    function __construct()
    {
        $this->callController();
    }

    private function callController()
    {
        $data = $this->getDataToCallController();

        call_user_func_array([
            $data['controller'],
            $data['method']],
            $data['params']
        );
    }

    /**
     * Получаем данные для вызова контроллера из $_GET
     * @return array Массив содержащий в себе название класса, метод и параметры
     */
    private function getDataToCallController()
    {
        $controller = $this->path . 'MainController';
        $controller = new $controller;
        $method = 'index';
        $params = array();

        $function = $_GET['url'];

        //Если Контроллер или Метод указан неверно, то вызывается дефолтный контроллер
        if (!empty($function)) {
            $data = explode('.', $function);
            $className = ucfirst($data[0]);
            $className = $className . "Controller";
            $className = $this->path . $className;
            if (class_exists($className)) {
                $controller = new $className;
                $method = $data[1];
                if (method_exists($controller, $method)) {
                    unset($data[0], $data[1]);
                    $entity = '';
                    foreach ($data as $value) {
                        $entity .= $value . '.';
                    }
                    $entity = substr($entity, 0, -1);
                    $params = [$entity];
                }
            }
        }
//        $controller = new $controller;
        return ['controller' => $controller, 'method' => $method, 'params' => $params];
    }
}