<?php

declare(strict_types=1);

namespace App\Controller;

use App\Core\Response;
use App\Core\View;
use App\Service\AuthService;

final class DashboardController
{
    public function __construct(
        private readonly View $view,
        private readonly AuthService $auth
    ) {
    }

    public function index(): void
    {
        $user = $this->auth->user();

        if ($user === null) {
            Response::redirect('/login');
        }

        $this->view->render('dashboard', [
            'user' => $user,
        ]);
    }
}
