<?php


class Router
{
    private $routes;

    public function  __construct()
    {
        $routesPath = ROOT. '/config/routes.php'; //путь к массиву маршрутов
        $this->routes = include($routesPath);  //присваиваем к свойству routes массив из файла routes

    }

    private function getURI()
    {
        if (!empty($_SERVER['REQUEST_URI'])) {
            return trim($_SERVER['REQUEST_URI'], '/');
        }
    }

    public function run ()
    {
        //получаем строку запроса
        $uri = $this->getURI();

        $path = null;

        //проверить наличие такого запроса в routes.php
        foreach ($this->routes as $uriPattern => $route) {
            if (empty($uriPattern))
            {
                if (empty($uri) || empty(explode('?', $uri)[0])) {
                    $path = $route;
                    break;
                }
            }
            else if (strpos($uri, $uriPattern) !== false)
            {
                $path = $route;
                break;
            }
        }

        if ($path === null)
        {
            http_response_code(404);
            exit();
        }

        $segments = explode('/', $path);
        $controllerName = array_shift($segments). 'Controller';
        $controllerName = ucfirst($controllerName);
        $actionName = 'action' . ucfirst(array_shift($segments));

        //подключить файл класса контроллера
        $controllerFile = ROOT . '/controllers/' .
            $controllerName . '.php';
        if (file_exists($controllerFile)) {
            include_once ($controllerFile);
        }

        //создать объект, вызвать метод
        $controllerObject = new $controllerName;
        call_user_func_array(array($controllerObject, $actionName), []);
    }
}