<?php

use DI\Container;
use Slim\Factory\AppFactory;
use Slim\Flash\Messages;
use Slim\Psr7\Factory\ResponseFactory;
use Slim\Psr7\Message;
use Slim\Views\PhpRenderer;
use Src\Controllers\AuthController;
use Src\Controllers\HomeController;
use Src\Controllers\ApiController;
use Src\Controllers\ComplexController;
use Src\Middleware\AdminMiddleware;
use Src\Middleware\ManagerMiddleware;
use Src\Middleware\AuthMiddleware;
use src\Controllers\BController;



require __DIR__ . '/vendor/autoload.php';
session_start();
$container = new Container();
AppFactory::setContainer($container);
$app = AppFactory::create();
$container->set(PhpRenderer::class, function () use ($container) {
    return new PhpRenderer(__DIR__ . '/templates', ['messages' => $container->get(Messages::class)]);
});
$container->set(Message::class, function () {
    return new Messages();
});


ORM::configure('mysql:host=database;dbname=docker');
ORM::configure('username', 'root');
ORM::configure('password', 'tiger');

$app->get('/login', [AuthController::class, "loginPage"]);
$app->post('/login', [AuthController::class, "login"]);
$app->get('/api/buildings/{slug}', [ApiController::class, "getBuilding"]);
$app->get('/api/apartments', [ApiController::class, "getApartments"]);


$app->group('/', function () use ($app) {

})->add(new AdminMiddleware($container->get(ResponseFactory::class)));


$app->group('/', function () use ($app) {

    #complex
    $app->get('/complex/create', [ComplexController::class, 'addComplexPage']);
    $app->post('/complex/create', [ComplexController::class, 'addComplex']);
    $app->get('/complex/{id}/edit', [ComplexController::class, 'editComplexPage']);
    $app->post('/complex/{id}/edit', [ComplexController::class, 'editComplex']);
    $app->get('/complex/{id}/delete', [ComplexController::class, 'complexDelete']);

    #buildings
    $app->get('/complex/{complex_id}/buildings/create', [BuildingController::class, 'addBuildingPage']);
    $app->post('/complex/{complex_id}/buildings/create', [BuildingController::class, 'addBuilding']);
    $app->get('/complex/{complex_id}/buildings/{building_id}/edit', [BuildingController::class, 'editBuildingPage']);
    $app->post('/complex/{complex_id}/buildings/{building_id}/edit', [BuildingController::class, 'editBuilding']);
    $app->get('/complex/{complex_id}/buildings/{building_id}/delete', [BuildingController::class, 'buildingDelete']);


    #apartments

})->add(new ManagerMiddleware($container->get(ResponseFactory::class)));


$app->group('/', function () use ($app) {
    $app->get('/', [HomeController::class, "home"]);
    $app->get('/logout', [AuthController::class, "logout"]);
    $app->get('/complex', [ComplexController::class, 'show']);
    $app->get('/complex/{complex_id}/buildings', [BController::class, 'show']);
})->add(new AuthMiddleware($container->get(ResponseFactory::class)));


$app->run();
