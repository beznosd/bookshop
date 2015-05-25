<?php

require_once __DIR__.'/Base/NamespaceAutoloader.php';

$autoloader = new \Base\NamespaceAutoloader();
$autoloader->addNamespace('Base', __DIR__.'/Base');
$autoloader->addNamespace('Controller', __DIR__.'/Controller');
$autoloader->addNamespace('Model', __DIR__.'/Model');
$autoloader->register();


//Получаем название контроллера, к которму пришел запрос и вызываем его
try{
	$controller = '\Controller\\'.\Base\Router::getController();
	$c = new $controller();
	$c->request();
}
catch(Exception $e)
{
	echo "Message: " . $e->getMessage();
}





