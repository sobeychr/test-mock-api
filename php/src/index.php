<?php

error_reporting(-1);

define('ROOT', dirname(__FILE__) . '/');

spl_autoload_register(function($classname) {
    require_once(ROOT . $classname . '.php');
});

$app = new App($_SERVER);

require_once(ROOT . 'getFile.php');
require_once(ROOT . 'routes.php');

if(file_exists(ROOT . 'routes.dev.php')) {
    require_once(ROOT . 'routes.dev.php');
}

$routesDir = ROOT . 'routes/';
if(file_exists($routesDir)) {
    if($handle = opendir($routesDir)) {
        while(false !== ($entry = readdir($handle))) {
            if(str_contains($entry, '.php')) {
                require_once($routesDir . $entry);
            }
        }
    }
}

$app->error(function() {
    return new Response([
        'status' => 404,
        'body' => 'Request not found',
    ]);
});
