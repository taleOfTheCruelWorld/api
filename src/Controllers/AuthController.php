<?php

namespace Src\Controllers;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class AuthController extends Controller
{
    public function loginPage (RequestInterface $request, ResponseInterface $response, $args) {
        return $this->renderer->render($response, '/auth/login.php');
    }
    public function login(RequestInterface $request, ResponseInterface $response, $args) {
        $login = $request->getParsedBody()['login'];
        $password = $request->getParsedBody()['password'];
        $user = \ORM::forTable("users")->where('login', $login)->findOne();
        if ($user == null) {
            $this->messages->addMessage('userMessage', 'This user does not exist');
            return $response->withStatus(302)->withHeader('Location', "/login");
        }
        if ( md5($password) == $user['password']) {
            $_SESSION['user_id'] = $user['id'];
            switch ($user['role']) {
            case 'admin':
                $_SESSION['user_role'] = $user['role'];
                break;
            case 'manager':
                $_SESSION['user_role'] = $user['role'];
                break;
            case 'reader':
                $_SESSION['user_role'] = $user['role'];
                break;
            }
                return $response->withStatus(302)->withHeader('Location', "/");
        }
        $this->messages->addMessage('userMessage', 'Password incorrect');
        return $response->withStatus(302)->withHeader('Location', "/login");
    }
    public function logout(RequestInterface $request, ResponseInterface $response, $args) {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_role']);
        return $response->withStatus(302)->withHeader('Location', "/");
    }
}
