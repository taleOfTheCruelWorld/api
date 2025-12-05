<?php

use DI\Container;
use Slim\Factory\AppFactory;
use Slim\Flash\Messages;
use Slim\Psr7\Factory\ResponseFactory;
use Slim\Psr7\Message;
use Slim\Views\PhpRenderer;



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


$app->run();
