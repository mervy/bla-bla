<?php

declare(strict_types=1);

namespace League\Plates;

final class Template
{
    private ?string $layoutName = null;
    private array $layoutData = [];
    private string $content = '';

    public function __construct(
        private readonly Engine $engine,
        private readonly array $sharedData,
        private readonly array $data
    ) {
    }

    public function layout(string $name, array $data = []): void
    {
        $this->layoutName = $name;
        $this->layoutData = $data;
    }

    public function section(string $name): string
    {
        if ($name === 'content') {
            return $this->content;
        }

        return '';
    }

    public function e(mixed $value): string
    {
        return htmlspecialchars((string) $value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    }

    public function renderFile(string $file): string
    {
        $vars = array_merge($this->sharedData, $this->data);
        extract($vars, EXTR_SKIP);

        ob_start();
        include $file;
        $output = (string) ob_get_clean();

        if ($this->layoutName === null) {
            return $output;
        }

        $layoutFile = $this->engine->resolve($this->layoutName);
        $layoutTemplate = new self($this->engine, $this->sharedData, array_merge($this->data, $this->layoutData));
        $layoutTemplate->content = $output;

        return $layoutTemplate->renderFile($layoutFile);
    }
}
