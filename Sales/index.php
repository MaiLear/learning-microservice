<?php
$baseUrl = $_GET['url'] ?? '';
$arrayBaseUrl = explode('/', $baseUrl);
$nameController = empty($arrayBaseUrl[0]) ? 'HomeController' : $arrayBaseUrl[0] . 'Controller';
$method =  empty($arrayBaseUrl[1]) ? 'index' : $arrayBaseUrl[1];
$parameter = '';
$mysqlRouteController = "./Controllers/Mysql/$nameController.php";
$mongoRouteController = "./Controllers/Mongodb/$nameController.php";
$routeController = file_exists($mysqlRouteController) ?  $mysqlRouteController : (file_exists($mongoRouteController) ? $mongoRouteController : false);


if (!empty($arrayBaseUrl[2])) {
    for ($i = 2; $i < count($arrayBaseUrl); $i++) {
        $parameter .= $arrayBaseUrl[$i] . ',';
    }
    $parameter = rtrim($parameter, ',');
}

if ($routeController) {
    require_once $routeController;
    $controller = new $nameController();
    if (method_exists($controller, $method)) {
        $controller->$method($parameter);
    } else {
        http_response_code(400);
        echo 'not found method';
    }
} else {
    http_response_code(400);
    echo 'file dont exists';
}
