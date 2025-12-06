<?php

namespace Src\Controllers;

use ORM;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use SlugController;
use src\Controllers\slug;

class ComplexController extends Controller
{

    public static function slugify($text, string $divider = '-')
    {
        // replace non letter or digits by divider
        $text = preg_replace('~[^\pL\d]+~u', $divider, $text);

        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        // trim
        $text = trim($text, $divider);

        // remove duplicate divider
        $text = preg_replace('~-+~', $divider, $text);

        // lowercase
        $text = strtolower($text);

        if (empty($text)) {
            return 'n-a';
        }

        return $text;
    }
    public function show(RequestInterface $request, ResponseInterface $response)
    {
        $complex = ORM::forTable('complex')->findArray();
        return $this->renderer->render($response, '/reader/complex/list.php', ['complex' => $complex]);
    }

    public function addComplexPage(RequestInterface $request, ResponseInterface $response)
    {
        return $this->renderer->render($response, '/manager/complex/create.php');
    }

    public function addComplex(RequestInterface $request, ResponseInterface $response)
    {

        $data = $request->getParsedBody();
        $slug = self::slugify($data['name']);
        ORM::forTable('complex')
            ->create(
                [
                    'name' => $data['name'],
                    'adress' => $data['adress'],
                    'latitude' => $data['latitude'],
                    'longitude' => $data['longitude'],
                    'slug' => $slug,
                ]
            )->save();

        return $response->withStatus(302)->withHeader('Location', '/complex');
    }
    public function editComplexPage(RequestInterface $request, ResponseInterface $response, $args)
    {
        $data = ORM::forTable('complex')->find_one($args['id']);

        return $this->renderer->render($response, '/manager/complex/edit.php', ['complex' => $data]);
    }

    public function editComplex(RequestInterface $request, ResponseInterface $response, $args)
    {

        $data = $request->getParsedBody();
        $slug = self::slugify($data['name']);
        ORM::forTable('complex')->findOne($args['id'])->set(
            [
                'name' => $data['name'],
                'adress' => $data['adress'],
                'latitude' => $data['latitude'],
                'longitude' => $data['longitude'],
                'slug' => $slug,
            ]
        )->save();

        return $response->withStatus(302)->withHeader('Location', '/complex');
    }

    public function complexDelete(RequestInterface $request, ResponseInterface $response, $args)
    {
        ORM::forTable('complex')->findOne($args['id'])->delete();

        return $response->withStatus(302)->withHeader('Location', '/complex');
    }
}