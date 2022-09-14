<?php

use League\Event\EventDispatcher;

include_once __DIR__ . '/config/app.php';
include_once __DIR__ . '/app/Http/Controllers/Controller.php';
include_once __DIR__ . '/app/Http/Controllers/ApplicationController.php';
include_once __DIR__ . '/app/Http/Controllers/DealController.php';
include_once __DIR__ . '/app/Providers/EventServiceProvider.php';
include_once __DIR__ . '/app/Models/Database.php';

if (true === APP_DEBUG)
{
    ini_set('display_errors', 1);
}

$database = new Database(DB_HOST, DB_DATABASE, DB_USERNAME, DB_PASSWORD);
$connection = $database->getConnection();
$action = $_GET['action'] ?? 'create';

$controller = new Controller();
$crudController = new ApplicationController($database);
$dealController = new DealController($database);
$dispatcher = new EventDispatcher();
$dispatcher->subscribeListenersFrom(new EventServiceProvider());

include_once __DIR__ . '/resources/views/_header.php';

include $controller->getRoute($action);

include_once __DIR__ . '/resources/views/_footer.php';
