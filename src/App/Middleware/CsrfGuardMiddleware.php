<?php

declare(strict_types=1);

namespace App\Middleware;

use Framework\Contracts\MiddlewareInterface;
use Framework\TemplateEngine;

class CsrfGuardMiddleware implements MiddlewareInterface
{

    public function __construct(private TemplateEngine $view)
    {
    }
    public function process(callable $next)
    {
        $requestMethod = strtoupper($_SERVER['REQUEST_METHOD']);
        $validMethods = ['POST', 'PUT', 'DELETE'];


        if (!in_array($requestMethod, $validMethods)) {
            $next();
            return;
        }

        if ($_SESSION['token'] !== $_POST['token']) {
            redirectTo('/');
        }

        unset($_SESSION['token']);

        $next();
    }
}
