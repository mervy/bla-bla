<?php

declare(strict_types=1);

namespace App\Controller;

use App\Core\Response;
use App\Core\Session;
use App\Core\View;
use App\Service\AuthService;

final class AuthController
{
    public function __construct(
        private readonly View $view,
        private readonly AuthService $auth
    ) {
    }

    public function showLogin(): void
    {
        if ($this->auth->check()) {
            Response::redirect('/dashboard');
        }

        $this->view->render('auth/login', [
            'error' => Session::flash('error'),
            'success' => Session::flash('success'),
        ]);
    }

    public function login(): void
    {
        $result = $this->auth->login($_POST['email'] ?? '', $_POST['password'] ?? '');

        if (!$result['ok']) {
            Session::flash('error', $result['error'] ?? 'Erro ao autenticar.');
            Response::redirect('/login');
        }

        Response::redirect('/dashboard');
    }

    public function showRegister(): void
    {
        if ($this->auth->check()) {
            Response::redirect('/dashboard');
        }

        $this->view->render('auth/register', [
            'error' => Session::flash('error'),
        ]);
    }

    public function register(): void
    {
        $result = $this->auth->register(
            $_POST['name'] ?? '',
            $_POST['username'] ?? '',
            $_POST['email'] ?? '',
            $_POST['password'] ?? ''
        );

        if (!$result['ok']) {
            Session::flash('error', $result['error'] ?? 'Erro ao cadastrar.');
            Response::redirect('/register');
        }

        Session::flash('success', 'Cadastro realizado com sucesso.');
        Response::redirect('/dashboard');
    }

    public function logout(): void
    {
        $this->auth->logout();
        Response::redirect('/login');
    }
}
