<?php

declare(strict_types=1);

namespace App\Middleware;

use Framework\Exceptions\ValidationException;
use Framework\Contracts\MiddlewareInterface;

class ValidationExceptionMiddleware implements MiddlewareInterface
{
    public function process(callable $next)
    {
        try {
            $next();
        } catch (ValidationException $e) {
            $oldFormData = $_POST;
            $excludeFields = ['password', 'confirmPassword'];
            $formatedData = array_diff_key($oldFormData, array_flip($excludeFields));
            $_SESSION["errors"] = $e->errors;
            $_SESSION['oldFormData'] = $formatedData;
            redirectTo($_SERVER["HTTP_REFERER"]);
        }
    }
}
