<?php
error_reporting(-1);

define('ROOT', dirname(__FILE__) . '/');

spl_autoload_register(function($classname) {
    require_once(ROOT . $classname . '.php');
});

$app = new App($_SERVER);

require_once(ROOT . 'getFile.php');
require_once(ROOT . 'middleware.php');
require_once(ROOT . 'routes.php');
