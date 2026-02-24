<?php

declare(strict_types=1);

use App\Config\Env;
use App\Controller\AuthController;
use App\Controller\DashboardController;
use App\Core\Response;
use App\Core\Router;
use App\Core\Session;
use App\Core\View;
use App\Database\Connection;
use App\Repository\UserRepository;
use App\Service\AuthService;

require __DIR__ . '/../vendor/autoload.php';

Env::load(__DIR__ . '/../.env');
Session::start();

$view = new View(__DIR__ . '/../views');
$pdo = Connection::get();
$userRepository = new UserRepository($pdo);
$authService = new AuthService($userRepository);

$authController = new AuthController($view, $authService);
$dashboardController = new DashboardController($view, $authService);

$router = new Router();
$router->get('/', fn () => $authService->check() ? Response::redirect('/dashboard') : Response::redirect('/login'));
$router->get('/login', fn () => $authController->showLogin());
$router->post('/login', fn () => $authController->login());
$router->get('/register', fn () => $authController->showRegister());
$router->post('/register', fn () => $authController->register());
$router->post('/logout', fn () => $authController->logout());
$router->get('/dashboard', fn () => $dashboardController->index());

$router->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
