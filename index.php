<?php
session_start();

require_once __DIR__.'/Base/NamespaceAutoloader.php';
define('ROOT_DIR', dirname(__FILE__));
define('SITE_URL', 'http://localhost/bookshop/?r=site/index');
define('SID', session_id());

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





