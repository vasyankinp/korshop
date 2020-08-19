<?php

namespace KorShop;

class Routes
{
    public $uri;
    public $array;

    public function get()
    {
        $controllerObject = null;
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $urlParts = explode('/', trim($uri, '/'));

        if (is_array($urlParts)) {
            if (isset($urlParts[0])) {
                $controllerName = ucfirst($urlParts[0]) . 'Controller';
                $pathToController = PATH . '/class/Controller/' . $controllerName . '.php';
                if (file_exists($pathToController)) {
                    include $pathToController;
                    $controllerName = 'KorShop\\Controller\\' . $controllerName;
                    $controllerObject = new $controllerName();
                }
            }

            if (!is_null($controllerObject)) {
                $controllerMethod = null;
                if (isset($urlParts[1])) {
                    $controllerMethod = $urlParts[1];

                    if (method_exists($controllerObject, $controllerMethod)) {
                        if (isset($urlParts[2])) {
                            $controllerMethodParam = $urlParts[2];
                            $controllerObject->$controllerMethod($controllerMethodParam);
                        } else {
                            $controllerObject->$controllerMethod();

                        }
                    }
                }
            }
        }
    }
}
