<?php

declare(strict_types=1);

use App\Core\Response;

$router->get('/', fn () => $authService->check() ? Response::redirect('/dashboard') : Response::redirect('/login'));
$router->get('/login', fn () => $authController->showLogin());
$router->post('/login', fn () => $authController->login());
$router->get('/register', fn () => $authController->showRegister());
$router->post('/register', fn () => $authController->register());
$router->post('/logout', fn () => $authController->logout());
$router->get('/dashboard', fn () => $dashboardController->index());
