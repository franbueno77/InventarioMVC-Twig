<?php

$controller = $_GET["controller"] ?? "Puesto";
$action = $_GET["action"] ?? "mostrar";


$controllerClass = "${controller}Controller";

require_once "control/${controllerClass}.php";

$instance = new  $controllerClass;

//die(var_dump( $instance, $action));

 $instance->$action();

