<?php
$routes=[];
 function route($action, $calback)
{
    global $routes;
    $action = trim($action, '/');
    $routes[$action] = $calback;
}
 function dispatch($action)
{
    global $routes;
    $action = trim($action, '/');
    $callback = $routes[$action];
    echo call_user_func($callback);
}