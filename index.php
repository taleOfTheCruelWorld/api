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
use Src\Controllers\BuildingController;
use Src\Controllers\LayoutController;
use Src\Controllers\ApartmentController;
use Src\Controllers\ImagesController;



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
$app->get('/api/complex/{slug}', [ApiController::class, "getComplex"]);
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

    #layouts
    $app->get('/complex/{complex_id}/layouts/create', [LayoutController::class, 'addLayoutPage']);
    $app->post('/complex/{complex_id}/layouts/create', [LayoutController::class, 'addLayout']);
    $app->get('/complex/{complex_id}/layouts/{layout_id}/edit', [LayoutController::class, 'editLayoutPage']);
    $app->post('/complex/{complex_id}/layouts/{layout_id}/edit', [LayoutController::class, 'editLayout']);
    $app->get('/complex/{complex_id}/layouts/{layout_id}/delete', [LayoutController::class, 'layoutDelete']);

    #buildings
    $app->get('/complex/{complex_id}/buildings/create', [BuildingController::class, 'addBuildingPage']);
    $app->post('/complex/{complex_id}/buildings/create', [BuildingController::class, 'addBuilding']);
    $app->get('/complex/{complex_id}/buildings/{building_id}/edit', [BuildingController::class, 'editBuildingPage']);
    $app->post('/complex/{complex_id}/buildings/{building_id}/edit', [BuildingController::class, 'editBuilding']);
    $app->get('/complex/{complex_id}/buildings/{building_id}/delete', [BuildingController::class, 'buildingDelete']);


    #apartments
    $app->get('/complex/{complex_id}/buildings/{building_id}/apartments/create', [ApartmentController::class, 'addApartmentPage']);
    $app->post('/complex/{complex_id}/buildings/{building_id}/apartments/create', [ApartmentController::class, 'addApartment']);
    $app->get('/complex/{complex_id}/buildings/{building_id}/apartments/{apartment_id}/edit', [ApartmentController::class, 'editApartmentPage']);
    $app->post('/complex/{complex_id}/buildings/{building_id}/apartments/{apartment_id}/edit', [ApartmentController::class, 'editApartment']);
    $app->get('/complex/{complex_id}/buildings/{building_id}/apartments/{apartment_id}/delete', [ApartmentController::class, 'apartmentDelete']);

    #apartment images
    $app->get('/complex/{complex_id}/buildings/{building_id}/apartments/{apartment_id}/images/create', [ImagesController::class, 'addImagePage']);
    $app->post('/complex/{complex_id}/buildings/{building_id}/apartments/{apartment_id}/images/create', [ImagesController::class, 'addImage']);
    $app->get('/complex/{complex_id}/buildings/{building_id}/apartments/{apartment_id}/images/{image_id}/edit', [ImagesController::class, 'editImagePage']);
    $app->post('/complex/{complex_id}/buildings/{building_id}/apartments/{apartment_id}/images/{image_id}/edit', [ImagesController::class, 'editImage']);
    $app->get('/complex/{complex_id}/buildings/{building_id}/apartments/{apartment_id}/images/{image_id}/delete', [ImagesController::class, 'imageDelete']);


})->add(new ManagerMiddleware($container->get(ResponseFactory::class)));


$app->group('/', function () use ($app) {
    $app->get('/', [HomeController::class, "home"]);
    $app->get('/logout', [AuthController::class, "logout"]);
    $app->get('/complex', [ComplexController::class, 'show']);
    $app->get('/complex/{complex_id}/layouts', [LayoutController::class, 'show']);
    $app->get('/complex/{complex_id}/buildings', [ComplexController::class, 'about']);
    $app->get('/complex/{complex_id}/buildings/{building_id}/apartments', [BuildingController::class, 'about']);
    $app->get('/complex/{complex_id}/buildings/{building_id}/apartments/{apartment_id}/images', [ApartmentController::class, 'images']);

})->add(new AuthMiddleware($container->get(ResponseFactory::class)));


$app->run();
