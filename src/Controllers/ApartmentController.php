<?php

namespace Src\Controllers;

use ORM;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class ApartmentController extends Controller
{

    public function addApartmentPage(RequestInterface $request, ResponseInterface $response, $args)
    {
        $layouts = ORM::forTable('layouts')->where('complex_id', $args['complex_id'])->findArray();
        return $this->renderer->render($response, '/manager/apartments/create.php', ['layouts' => $layouts]);
    }

    public function addApartment(RequestInterface $request, ResponseInterface $response, $args)
    {

        $data = $request->getParsedBody();

        ORM::forTable('apartments')
            ->create(
                [
                    'rooms' => $data['rooms'],
                    'floor' => $data['floor'],
                    'price' => $data['price'],
                    'layout_id' => $data['layout_id'],
                    'buildings_id' => $args['building_id']
                ]
            )->save();

        return $response->withStatus(302)->withHeader('Location', '/complex/' . $args['complex_id'] . '/buildings/' . $args['building_id'] . '/apartments');
    }
    public function editApartmentPage(RequestInterface $request, ResponseInterface $response, $args)
    {

        $apartment = ORM::forTable('apartments')->findOne($args['apartment_id']);
        $layouts = ORM::forTable('layouts')->where('complex_id', $args['complex_id'])->findArray();
        return $this->renderer->render($response, '/manager/apartments/edit.php', ['apartment' => $apartment, 'layouts' => $layouts]);
    }

    public function editApartment(RequestInterface $request, ResponseInterface $response, $args)
    {

        $data = $request->getParsedBody();

        ORM::forTable('apartments')->findOne($args['apartment_id'])->set(
            [
                'rooms' => $data['rooms'],
                'floor' => $data['floor'],
                'price' => $data['price'],
                'layout_id' => $data['layout_id'],
            ]
        )->save();

        return $response->withStatus(302)->withHeader('Location', '/complex/' . $args['complex_id'] . '/buildings/' . $args['building_id'] . '/apartments');
    }

    public function apartmentDelete(RequestInterface $request, ResponseInterface $response, $args)
    {
        ORM::forTable('apartments')->findOne($args['apartment_id'])->delete();

        return $response->withStatus(302)->withHeader('Location', '/complex/' . $args['complex_id'] . '/buildings/' . $args['building_id'] . '/apartments');
    }

    public function images(RequestInterface $request, ResponseInterface $response, $args)
    {
        $images = ORM::forTable('images_of_apartments')->where('apartments_id', $args['apartment_id'])->findArray();
        return $this->renderer->render($response, '/reader/apartments/about.php', ['images' => $images, 'complex_id' => $args['complex_id'], 'building_id' => $args['building_id'], 'apartment_id' => $args['apartment_id']]);
    }

}