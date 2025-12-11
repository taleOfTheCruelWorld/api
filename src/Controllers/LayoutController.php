<?php

namespace Src\Controllers;

use ORM;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class LayoutController extends Controller
{

    public function show(RequestInterface $request, ResponseInterface $response, $args)
    {
        $layouts = ORM::forTable('layouts')->where('complex_id', $args['complex_id'])->findArray();
        return $this->renderer->render($response, '/reader/complex/layouts.php', ['layouts' => $layouts, 'complex_id' => $args['complex_id']]);
    }
}

