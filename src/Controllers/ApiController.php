<?php

namespace Src\Controllers;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class ApiController extends Controller
{
    public function getBuilding(RequestInterface $request, ResponseInterface $response, $args) {
        $data = [
            'name' => 'Complex',
            'adress'=> 'dadsa',
            'latitude'=>'41,312',
            'longtude'=>'321,4',
            'sectors' => [
                [
                'id'=> '2',
                'planning' => '2025-02-31',
                'floors' => '15'
                ]
            ],
            'layouts' => [
                [
                    'id'=>'123',
                    'image'=>'https://da.dsa',
                ]
            ]
        ];
        $response->getBody()->write(json_encode($data));
        return $response->withHeader('Content-Type', 'aplication/json');
    }
    public function getApartments(RequestInterface $request, ResponseInterface $response, $args) {
        $data = \ORM::forTable('apartments')->join('image_of_apartments', array('image_of_', '=', 'p2.id'))->findArray();
        $response->getBody()->write(json_encode($data));
        return $response->withHeader('Content-Type', 'aplication/json');
    }
}
