<?php

use Monolog\Level;
use Monolog\Logger;
use app\core\Application;
use Monolog\Handler\StreamHandler;
use app\controllers\SiteController;

/** Require Autoload */
require_once __DIR__ . "/../vendor/autoload.php";

/** Require DotEnv */
$dotenv = \Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

/** Include Whoops */
$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

$logger = new Logger('logs');
$logger->pushHandler(new StreamHandler(dirname(__DIR__) . '/logs/file.logs', Level::Warning));

$config = [
    'database' => [
        'dsn' => $_ENV['DB_DSN'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD'],
    ]
];

$app = new Application(dirname(__DIR__), $config, $logger);

$app->router->get('/', [SiteController::class, 'home']);

$app->run();