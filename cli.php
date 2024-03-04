<?php

declare(strict_types=1);

require __DIR__ . "/vendor/autoload.php";

use Framework\Database;
use Dotenv\Dotenv;
use App\Config\Paths;

$dotenv = Dotenv::createImmutable(Paths::ROOT);
$dotenv->load();

$data = [
    'host' => 'localhost',
    'port' => '3306',
    'dbname' => 'php_mvc',
];
$user = 'root';
$password = 'Dieuest1.';
$driver = 'mysql';
$db = new Database($_ENV['DB_DRIVER'], $data,  $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD']);


$sqlFile = file_get_contents("./database.sql");
$db->query($sqlFile);
