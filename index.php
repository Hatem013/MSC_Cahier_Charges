<?php

define('ROOT', str_replace('index.php', '', $_SERVER['SCRIPT_FILENAME']));

require_once(ROOT.'App/Model.php');
require_once(ROOT.'App/Controller.php');


$params = explode('/', $_GET['p']);

if($params[0] != ""){
    $controller = ucfirst($params[0]);

    $action = isset($params[1]) ? $params[1] : 'index';

    require_once(ROOT.'Controllers/'.$controller.'Controller'.'.php');

    $controller = new $controller();

    if(method_exists($controller, $action)){

        unset($params[0]);
        unset($params[1]);

        call_user_func_array([$controller, $action], $params);
    }else{
        http_response_code(404);
        echo "La page recherchée n'existe pas";
    }
}else{
    $pageName = $params[0];
    $viewPath = ROOT."views/$pageName.php";

    if(file_exists($viewPath)){
        require_once($viewPath);
        exit();
    }else{
        http_response_code(404);
        echo "La page recherchée n'existe pas";
    }
}