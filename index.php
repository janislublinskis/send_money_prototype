<?php

include __DIR__ . '/config/app.php';
include __DIR__ . '/app/Http/Controllers/Controller.php';
include __DIR__ . '/app/Http/Controllers/PropertyController.php';
include __DIR__ . '/app/Models/Database.php';

if (true === APP_DEBUG)
{
    ini_set('display_errors', 1);
}

$database = new Database(DB_HOST, DB_DATABASE, DB_USERNAME, DB_PASSWORD);
$connection = $database->getConnection();
$page = $_GET['page'] ?? 'properties';
$action = $_GET['action'] ?? 'index';

$controller = new Controller();
$crudController = new PropertyController($database);

include __DIR__ . '/resources/views/_header.php';

include $controller->getRoute($page, $action);

include __DIR__ . '/resources/views/_footer.php';