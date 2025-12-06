<?php

namespace Src\Controllers;

use ORM;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class BuildingController extends Controller
{

    public function show(RequestInterface $request, ResponseInterface $response)
    {
        $buildings = ORM::forTable('buildings')->findArray();
        return $this->renderer->render($response, '/reader/buildings/list.php', ['buildings' => $buildings]);
    }

    public function addBuildingPage(RequestInterface $request, ResponseInterface $response)
    {
        return $this->renderer->render($response, '/manager/buildings/create.php');
    }

    public function addBuilding(RequestInterface $request, ResponseInterface $response, $args)
    {

        $data = $request->getParsedBody();

        ORM::forTable('complex')
            ->create(
                [
                    'name' => $data['name'],
                    'adress' => $data['adress'],
                    'latitude' => $data['latitude'],
                    'longitude' => $data['longitude'],
                ]
            )->save();

        return $response->withStatus(302)->withHeader('Location', '/complex/' . $args['id'] . '/buildings');
    }
    public function editBuildingPage(RequestInterface $request, ResponseInterface $response, $args)
    {
        $data = ORM::forTable('buildings')->find_one($args['building_id']);

        return $this->renderer->render($response, '/manager/buildings/edit.php', ['building' => $data]);
    }

    public function editBuilding(RequestInterface $request, ResponseInterface $response, $args)
    {

        $data = $request->getParsedBody();

        ORM::forTable('complex')->findOne($args['id'])->set(
            [
                'name' => $data['name'],
                'adress' => $data['adress'],
                'latitude' => $data['latitude'],
                'longitude' => $data['longitude'],

            ]
        )->save();

        return $response->withStatus(302)->withHeader('Location', '/complex/' . $args['id'] . '/buildings');
    }

    public function buildingDelete(RequestInterface $request, ResponseInterface $response, $args)
    {
        ORM::forTable('complex')->findOne($args['id'])->delete();

        return $response->withStatus(302)->withHeader('Location', '/complex/' . $args['id'] . '/buildings');
    }

}