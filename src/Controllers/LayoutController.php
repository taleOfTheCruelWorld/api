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
    public function addLayoutPage(RequestInterface $request, ResponseInterface $response, $args)
    {
        return $this->renderer->render($response, '/manager/layouts/create.php');
    }
    public function addLayout(RequestInterface $request, ResponseInterface $response, $args)
    {


        $uploaddir = $_SERVER['DOCUMENT_ROOT'] . '/layouts/';
        $uploadfile = $uploaddir . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $uploadfile);
        
        ORM::forTable('layouts')->create(
            [
                'image' => $_FILES['image']['name'],
                'complex_id' => $args['complex_id']
            ]
        )->save();

        return $response->withStatus(302)->withHeader('Location', '/complex/' . $args['complex_id'] . '/layouts');
    }
    public function editLayoutPage(RequestInterface $request, ResponseInterface $response, $args)
    {
        $layout = ORM::forTable('layouts')->findOne($args['layout_id']);
        return $this->renderer->render
        ($response, '/manager/layouts/edit.php', ['layout' => $layout]);
    }
    public function editLayout(RequestInterface $request, ResponseInterface $response, $args)
    {
        $uploaddir = $_SERVER['DOCUMENT_ROOT'] . '/layouts/';
        $uploadfile = $uploaddir . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $uploadfile);

        $data = $request->getParsedBody();
        ORM::forTable('layouts')->findOne($args['layout_id'])->set(
            [
                'image' => $_FILES['image']['name'],
            ]
        )->save();
        return $response->withStatus(302)->withHeader('Location', '/complex/' . $args['complex_id'] . '/layouts');
    }
    public function layoutDelete(RequestInterface $request, ResponseInterface $response, $args)
    {
        ORM::forTable('layouts')->findOne($args['layout_id'])->delete();
        return $response->withStatus(302)->withHeader('Location', '/complex/' . $args['complex_id'] . '/layouts');
    }
}

