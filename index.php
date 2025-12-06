<?php

use DI\Container;
use Slim\Factory\AppFactory;
use Slim\Flash\Messages;
use Slim\Psr7\Factory\ResponseFactory;
use Slim\Psr7\Message;
use Slim\Views\PhpRenderer;
use Src\Controllers\AuthController;
use Src\Controllers\HomeController;
use Src\Middleware\AuthMiddleware;
use Src\Controllers\ApiController;



require __DIR__ . '/vendor/autoload.php';
session_start();
$container = new Container();
AppFactory::setContainer ($container);
$app = AppFactory::create();
$container->set(PhpRenderer::class, function() use ($container) {
    return new PhpRenderer (__DIR__ . '/templates', ['messages'=> $container->get(Messages::class)]);
});
$container->set(Message::class, function() {
    return new Messages();
});


ORM::configure('mysql:host=database;dbname=docker');
ORM::configure('username', 'root');
ORM::configure('password', 'tiger');

$app->get('/login', [AuthController::class, "loginPage"]);
$app->post('/login', [AuthController::class, "login"]);
$app->get('/api/buildings/{slug}', [ApiController::class, "getBuilding"]);
$app->get('/api/apartments', [ApiController::class, "getApartments"]);

$app->group('/', function() use ($app){
    $app->get('/logout', [AuthController::class, "logout"]);
    $app->get('/', [HomeController::class, "home"]);
})->add(new AuthMiddleware($container->get(ResponseFactory::class)));
$app->run();
