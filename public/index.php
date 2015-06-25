<?php

define('ROOT_DIR', realpath(dirname(__FILE__) . '/../' ));
require_once ROOT_DIR . '/vendor/autoload.php';

use LocalBooking\Config\SlimLoader;
use Illuminate\Database\Capsule\Manager as Capsule;
use Slim\Slim;

$app = new Slim();

ini_set('display_errors', 1);

// start framework configuration
$app->container->singleton('configuration', function() use ($app) {
    return new SlimLoader($app);
});
$app->configuration->import(ROOT_DIR . '/app/config.yml')->refresh();

// database
$configuration = $app->config('database');
if (!empty($configuration)) {
    $app->container->singleton('database', function () {
        return new Capsule();
    });
    $app->database->addConnection($configuration);
    $app->database->setAsGlobal();
    $app->database->bootEloquent();
}

$app->get('/', function () {
    echo file_get_contents('index.html');
});

// load controller
foreach($app->config('routes') as $class) {
    $ref = new ReflectionClass($class);
    if ($ref->implementsInterface('LocalBooking\Controller\ControllerInterface')) {
        $controller = new $class();
        $controller->enable($app);
    }
}

$app->run();
