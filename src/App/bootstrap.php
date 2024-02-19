<?php

declare(strict_types=1);

include __DIR__ . "/../../vendor/autoload.php";

use Framework\App;
use App\Config\Paths;
use function App\Config\{registerMiddleWare, registerRoutes};

$app = new App(Paths::SOURCE . "App/container-definitions.php");
registerRoutes($app);
registerMiddleWare($app);

return $app;
