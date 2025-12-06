<?php

namespace Src\Controllers;

use ORM;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use src\Service;
class ComplexController extends Controller
{

    public function addComplexPage(RequestInterface $request, ResponseInterface $response)
    {
        return $this->renderer->render($response, '/manager/complex/create.php');
    }

    public function addComplex(RequestInterface $request, ResponseInterface $response)
    {

        $data = getParsedBody();
        $slug = slugify($data['name']);
        ORM::forTable('complex')
            ->create(
                [
                    'name' => $data['name'],
                    'adress' => $data['adress'],
                    'latitude' => $data['latitude'],
                    'longitude' => $data['longitude'],
                    'slug' => $slug,
                ]
            );
    }
    public function editComplexPage(RequestInterface $request, ResponseInterface $response, $args)
    {
        $data = ORM::forTable('complex')->find_one($args['id']);

        return $this->renderer->render($response, '/manager/complex/{id}/edit.php', ['complex' => $data]);
    }

    public function editComplex(RequestInterface $request, ResponseInterface $response, $args)
    {

        $data = getParsedBody();
        $slug = slugify($data['name']);
        ORM::forTable('complex')->findOne('id')->set(ORM::forTable('complex')
            ->create(
                [
                    'name' => $data['name'],
                    'adress' => $data['adress'],
                    'latitude' => $data['latitude'],
                    'longitude' => $data['longitude'],
                    'slug' => $slug,
                ]
            ));

        return $response->withStatus(302)->withHeader('Location', '/complex');
    }

    public function deleteComplex(RequestInterface $request, ResponseInterface $response, $args)
    {
        ORM::forTable('complex')->findOne($args['id'])->delete();

        return $response->withStatus(302)->withHeader('Location', '/complex');
    }
}