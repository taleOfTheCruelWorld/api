<?php

namespace Src\Controllers;

use ORM;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class ImagesController extends Controller
{

    public function addImagePage(RequestInterface $request, ResponseInterface $response, $args)
    {
        return $this->renderer->render($response, '/manager/images/create.php');
    }

    public function addImage(RequestInterface $request, ResponseInterface $response, $args)
    {

        $uploaddir = $_SERVER['DOCUMENT_ROOT'] . '/images_of_apartments/';
        $uploadfile = $uploaddir . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $uploadfile);

        ORM::forTable('images_of_apartments')
            ->create(
                [
                    'image' => $_FILES['image']['name'],
                    'apartments_id' => $args['apartment_id'],
                ]
            )->save();

        return $response->withStatus(302)->withHeader('Location', '/complex/' . $args['complex_id'] . '/buildings/' . $args['building_id'] . '/apartments/' . $args['apartment_id'] . '/images');
    }
    public function editImagePage(RequestInterface $request, ResponseInterface $response, $args)
    {

        $image = ORM::forTable('images_of_apartments')->findOne($args['image_id']);

        return $this->renderer->render($response, '/manager/images/edit.php', ['apartment' => $image]);
    }

    public function editImage(RequestInterface $request, ResponseInterface $response, $args)
    {

        $uploaddir = $_SERVER['DOCUMENT_ROOT'] . '/images_of_apartments/';
        $uploadfile = $uploaddir . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $uploadfile);

        ORM::forTable('images_of_apartments')
            ->findOne($args['image_id'])
            ->set(
                [
                    'image' => $_FILES['image']['name'],
                ]
            )->save();

        return $response->withStatus(302)->withHeader('Location', '/complex/' . $args['complex_id'] . '/buildings/' . $args['building_id'] . '/apartments/' . $args['apartment_id'] . '/images');
    }

    public function imageDelete(RequestInterface $request, ResponseInterface $response, $args)
    {
        ORM::forTable('images_of_apartments')->findOne($args['image_id'])->delete();

        return $response->withStatus(302)->withHeader('Location', '/complex/' . $args['complex_id'] . '/buildings/' . $args['building_id'] . '/apartments/' . $args['apartment_id'] . '/images');
    }

}