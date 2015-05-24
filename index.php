<?php

require_once __DIR__.'/Base/NamespaceAutoloader.php';

$autoloader = new \Base\NamespaceAutoloader();
$autoloader->addNamespace('Base', __DIR__.'/Base');
$autoloader->addNamespace('Controller', __DIR__.'/Controller');
$autoloader->register();

//Получаем название контроллера, к которму пришел запрос
try{
	$controller = '\Controller\\'.\Base\Router::getController();
	$c = new $controller();
	$c->request();
}
catch(Exception $e)
{
	echo "Message: " . $e->getMessage();
}





