<?php

namespace Src\Controllers;

use ORM;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class BuildingController extends Controller
{

    public function about(RequestInterface $request, ResponseInterface $response, $args)
    {
        $apartments = ORM::for_table('apartments')
            ->table_alias('p1')
            ->select('p1.*')
            ->select('p2.image', 'layout')
            ->join('layouts', array('p1.layout_id', '=', 'p2.id'), 'p2')
            ->find_array();

        return $this->renderer->render($response, '/reader/buildings/about.php', ['apartments' => $apartments, 'complex_id' => $args['complex_id'], 'building_id' => $args['building_id']]);
    }


    public function addBuildingPage(RequestInterface $request, ResponseInterface $response)
    {
        return $this->renderer->render($response, '/manager/buildings/create.php');
    }

    public function addBuilding(RequestInterface $request, ResponseInterface $response, $args)
    {

        $data = $request->getParsedBody();

        ORM::forTable('buildings')
            ->create(
                [
                    'name' => $data['name'],
                    'planning_date' => $data['planning_date'],
                    'floors' => $data['floors'],
                    'complex_id' => $args['complex_id']
                ]
            )->save();

        return $response->withStatus(302)->withHeader('Location', '/complex/' . $args['complex_id'] . '/buildings');
    }
    public function editBuildingPage(RequestInterface $request, ResponseInterface $response, $args)
    {
        $data = ORM::forTable('buildings')->find_one($args['building_id']);

        return $this->renderer->render($response, '/manager/buildings/edit.php', ['building' => $data]);
    }

    public function editBuilding(RequestInterface $request, ResponseInterface $response, $args)
    {

        $data = $request->getParsedBody();

        ORM::forTable('buildings')->findOne($args['building_id'])->set(
            [
                'name' => $data['name'],
                'planning_date' => $data['planning_date'],
                'floors' => $data['floors'],
            ]
        )->save();

        return $response->withStatus(302)->withHeader('Location', '/complex/' . $args['complex_id'] . '/buildings');
    }

    public function buildingDelete(RequestInterface $request, ResponseInterface $response, $args)
    {
        ORM::forTable('buildings')->findOne($args['building_id'])->delete();

        return $response->withStatus(302)->withHeader('Location', '/complex/' . $args['complex_id'] . '/buildings');
    }

}