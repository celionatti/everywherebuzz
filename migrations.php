<?php

use Monolog\Level;
use Monolog\Logger;
use app\core\Application;
use Monolog\Handler\StreamHandler;

/** Require Autoload */
require_once __DIR__ . "/vendor/autoload.php";

/** Require DotEnv */
$dotenv = \Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$logger = new Logger('logs');
$logger->pushHandler(new StreamHandler(dirname(__DIR__) . '/logs/file.logs', Level::Warning));

$config = [
    'database' => [
        'dsn' => $_ENV['DB_DSN'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD'],
    ]
];

$app = new Application(__DIR__, $config, $logger);

$app->database->applyMigrations();