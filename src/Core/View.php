<?php

declare(strict_types=1);

namespace App\Core;

use App\Config\Config;
use League\Plates\Engine;

final class View
{
    private Engine $engine;

    public function __construct(string $path)
    {
        $this->engine = new Engine($path);
        $this->engine->addData([
            'appName' => Config::appName(),
        ]);
    }

    public function render(string $template, array $data = []): void
    {
        echo $this->engine->render($template, $data);
    }
}
