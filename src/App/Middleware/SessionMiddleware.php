<?php

declare(strict_types=1);

namespace App\Middleware;

use Framework\Contracts\MiddlewareInterface;
use App\Exceptions\SessionException;

class SessionMiddleware implements MiddlewareInterface
{
    public function process(callable $next)
    {
        if (session_status() == PHP_SESSION_ACTIVE) {
            throw new SessionException("Session already started");
        }

        if (headers_sent($filename, $line)) {
            throw new SessionException("Header already sent " . $filename . " on line " . $line);
        }

        session_set_cookie_params(
            [
                'secure' => $_ENV['APP_ENV'] == 'production', // this to prevent cookies from being sent on unsecure connections
                'httponly' => true, // this to prevent javascript access to cookies
                'samesite' => 'lax', // this to prevent CSRF attacks

            ]
        );

        session_start();
        $next();
        session_write_close();
    }
}
