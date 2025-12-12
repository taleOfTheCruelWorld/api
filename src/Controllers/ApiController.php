<?php

namespace Src\Controllers;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class ApiController extends Controller
{
    public function getComplex(RequestInterface $request, ResponseInterface $response, $args) {
        $complex = \ORM::forTable('complex')->where('slug',$args['slug'])->findOne();
        if (!$complex) {
            $data = null;
            $response->getBody()->write(json_encode($data));
            return $response->withHeader('Content-Type', 'aplication/json');
        }
        $buildings = \ORM::forTable('buildings')->where('complex_id', $complex['id'])->findArray();
        $layouts= \ORM::forTable('layouts')->where('complex_id',$complex['id'])->findArray();
        $data = [
            'name' => $complex['name'],
            'adress'=> $complex['adress'],
            'latitude'=>$complex['latitude'],
            'longitude'=>$complex['longitude'],
            'sectors' => $buildings,           
            'layouts' => $layouts       
        ];
        $response->getBody()->write(json_encode($data));
        return $response->withHeader('Content-Type', 'application/json');
    }
    public function getApartments(RequestInterface $request, ResponseInterface $response, $args) {
        $data = \ORM::forTable('apartments')->rawQuery('SELECT ap.*, JSON_ARRAYAGG(im.image) AS images FROM `apartments` as ap LEFT JOIN images_of_apartments as im on ap.id=im.apartments_id GROUP BY ap.id')->findArray();
        $response->getBody()->write(json_encode($data));
        return $response->withHeader('Content-Type', 'application/json');
    }
}
