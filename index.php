<?php
ini_set('display_errors', 1);
date_default_timezone_set("Africa/Douala");
define('ROOT',__DIR__);
define('LANG',__DIR__.'/lang');
define('ROOT_SITE','http://brancos.log/Public/');
define('ROOT_URL','http://brancos.log/');
define('PATH_FILE',realpath(dirname(__FILE__)));
define('MYSQL_DATETIME_FORMAT','Y-m-d H:i:s');
define('MYSQL_DATE_FORMAT','Y-m-d');
define('DATE_FORMAT','d-m-Y');
define('DATE_COURANTE',date(MYSQL_DATETIME_FORMAT));
function var_die($value){
	echo '<pre>';
	var_dump($value);
	echo '</pre>';
	die();
}
function thousand($value){
	return number_format($value,0,',',' ');
}
function is_ajax(){
    return !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}
require 'vendor/autoload.php';
require 'Core/Autoloader.php';
$routes = require 'routes.php';
\Projet\Autoloader::register();
\Projet\Model\Router::call($routes);