<?php

namespace Src\Controllers;

use ORM;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class UserController extends Controller
{

    public function addUserPage(RequestInterface $request, ResponseInterface $response)
    {
        return $this->renderer->render($response, '/admin/newUser.php');
    }

    public function addUser(RequestInterface $request, ResponseInterface $response)
    {
        $data = getParsedBody();
        ORM::forTable('users')
            ->create(
                [
                    'login' => $data['login'],
                    'password' => md5($data['password']),
                    'role' => $data['role']
                ]
            )
            ->save();

        return $response->withStatus(302)->withHeader('Location', '/');
    }

}