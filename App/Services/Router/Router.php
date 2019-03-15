<?php

namespace App\Services\Router;

class Router
{
    public static $routes;
    const BASE_CONTROLLER = "\App\Controller\\";

    public static function start()
    {
        //get All Routes
        self::$routes = include BASE_PATH . "routes/web.php";
        //get Current Routes
        $currentRoute = self::getCurrentRoute();

        //check if Route Exist
        if (self::checkCurrentRouteExist($currentRoute)) {

            //is Allowed Method
            if (!in_array(strtolower($_SERVER['REQUEST_METHOD']), self::getAllowMethods($currentRoute))) {
                header('HTTP/1.1 403 Forbidden');
                echo "403.html";
                die();

            }

            //get Current Routes Target
            $target = self::getRouteTarget($currentRoute);
            list($controllerClass, $method) = explode('@', $target);
            $fullControllerClass = self::BASE_CONTROLLER . $controllerClass;
            if (!class_exists($fullControllerClass)) {
                echo "Class is not Exist";
                die();
            }
            $controller = new $fullControllerClass;
            if (method_exists($controller, $method)) {
                //Call Method From Controller
                $controller->$method();

            } else {
                echo "Method not Exist";
                die();
            }


        } else {
            header("HTTP/1.0 404 Not Found");
            echo "404.html";
            die();
        }


    }

    public static function getCurrentRoute()
    {

        return strtok(strtolower($_SERVER['REQUEST_URI']), '?');
    }

    public static function checkCurrentRouteExist($route)
    {
        if (array_key_exists($route, self::$routes)) {
            return true;
        }
        return false;
    }

    public static function getRouteTarget($route)
    {
        return self::$routes[$route]['target'];
    }

    public static function getAllowMethods($route)
    {
        return explode('|', self::$routes[$route]['method']);
    }

}