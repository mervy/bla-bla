<?php

declare(strict_types=1);

namespace League\Plates;

final class Engine
{
    private array $sharedData = [];

    public function __construct(private readonly string $directory)
    {
    }

    public function addData(array $data): void
    {
        $this->sharedData = array_merge($this->sharedData, $data);
    }

    public function render(string $template, array $data = []): string
    {
        $templateFile = $this->resolve($template);
        $templateObject = new Template($this, $this->sharedData, $data);

        return $templateObject->renderFile($templateFile);
    }

    public function resolve(string $name): string
    {
        $path = rtrim($this->directory, '/\\') . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $name) . '.php';
        if (!is_file($path)) {
            throw new \RuntimeException('Template não encontrado: ' . $name);
        }

        return $path;
    }
}
