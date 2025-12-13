<?php

namespace Src\Controllers;

use ORM;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class UserController extends Controller
{

    public function usersPage(RequestInterface $request, ResponseInterface $response)
    {
        $users = ORM::forTable('users')->find_array();
        return $this->renderer->render($response, '/admin/users.php', ['users' => $users]);
    }

    public function addUserPage(RequestInterface $request, ResponseInterface $response)
    {
        return $this->renderer->render($response, '/admin/newUser.php');
    }

    public function addUser(RequestInterface $request, ResponseInterface $response)
    {
        $data = $request->getParsedBody();
        ORM::forTable('users')
            ->create(
                [
                    'login' => $data['login'],
                    'password' => md5($data['password']),
                    'role' => $data['role']
                ]
            )
            ->save();

        return $response->withStatus(302)->withHeader('Location', '/admin/users');
    }
    public function editUserPage(RequestInterface $request, ResponseInterface $response, $args)
    {
        $user = ORM::for_table('users')->find_one($args['user_id']);
        $login = $user['login'];
        return $this->renderer->render($response, '/admin/editUser.php', ['login' => $login]);
    }

    public function editUser(RequestInterface $request, ResponseInterface $response, $args)
    {
        $data = $request->getParsedBody();
        ORM::forTable('users')
            ->findOne($args['user_id'])
            ->set(
                [
                    'login' => $data['login'],
                    'password' => md5($data['password']),
                    'role' => $data['role']
                ]
            )
            ->save();

        return $response->withStatus(302)->withHeader('Location', '/admin/users');
    }

    public function deleteUser(RequestInterface $request, ResponseInterface $response, $args)
    {
        ORM::for_table('users')->find_one($args['user_id'])->delete();

        return $response->withStatus(302)->withHeader('Location', '/admin/users');
    }
}