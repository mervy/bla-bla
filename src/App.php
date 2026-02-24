<?php

declare(strict_types=1);

namespace App;

use App\Config\Env;
use App\Controller\AuthController;
use App\Controller\DashboardController;
use App\Core\Router;
use App\Core\Session;
use App\Core\View;
use App\Database\Connection;
use App\Model\UserModel;
use App\Service\AuthService;

final class App
{
    public function run(string $basePath): void
    {
        Env::load($basePath . '/.env');
        Session::start();

        $view = new View($basePath . '/views');
        $pdo = Connection::get();
        $userModel = new UserModel($pdo);
        $authService = new AuthService($userModel);

        $authController = new AuthController($view, $authService);
        $dashboardController = new DashboardController($view, $authService);

        $router = new Router();

        (static function (Router $router, AuthController $authController, DashboardController $dashboardController, AuthService $authService): void {
            require __DIR__ . '/../config/routes.php';
        })($router, $authController, $dashboardController, $authService);

        $router->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
    }
}
