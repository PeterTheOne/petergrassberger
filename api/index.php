<?php

// functions
function displayError() {
    displayStatic('html/404.html');
}

function displayStatic($path) {
    if (file_exists($path)) {
        echo file_get_contents($path);
        exit;
    }
    displayError();
}

function displayModel($path, $className, $action) {
    if (is_file($path)) {
        include_once($path);
        if (class_exists($className)) {
            $controller = new $className;
            $actionMethod = $action . 'Action';
            $result = json_encode($controller->$actionMethod());

            //todo:set header
            echo $result;
            exit;
        }
    }
    displayError();
}

// init
//todo: remove on deployment
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', true);

$site = isset($_GET['site']) ? $_GET['site'] : '';
$routes = json_decode(file_get_contents('routes.json'));

// find currentRoute
$route = null;
foreach ($routes as $currentRoute) {
    if ($currentRoute->url === $site) {
        $route = $currentRoute;
        break;
    }
}
if ($route === null) {
    displayError();
}

// fetch and display content
if ($route->type === 'static') {
    displayStatic($route->path);
} else if ($route->type === 'model') {
    //todo: select action
    displayModel($route->path, $route->className, 'get');
} else {
    displayError();
}


?>
