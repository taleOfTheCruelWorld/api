<?php

namespace Src\Controllers;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class HomeController extends Controller
{
    public function home(RequestInterface $request, ResponseInterface $response, $args) {
        return $this->renderer->render($response, '/home.php');
    }
}
