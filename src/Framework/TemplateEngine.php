<?php

declare(strict_types=1);

namespace Framework;


class TemplateEngine
{
    private array $globaleTemplateData = [];

    public function __construct(private string $basePath)
    {
    }

    public function render(string $template, array $data = [])
    {
        extract($data, EXTR_SKIP);
        extract($this->globaleTemplateData, EXTR_SKIP);
        ob_start();
        include $this->resolve($template);
        $output = ob_get_contents();
        ob_end_clean();
        return $output;
    }

    public function resolve($path)
    {
        return "$this->basePath/{$path}";
    }

    public function addGlobale(string $key, mixed $value)
    {
        $this->globaleTemplateData[$key] = $value;
    }
}
