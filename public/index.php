<?php

use Monolog\Level;
use Monolog\Logger;
use app\core\Application;
use Monolog\Handler\StreamHandler;
use app\controllers\AuthController;
use app\controllers\SiteController;
use app\controllers\AdminController;

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

/** Auth Routes */
$app->router->get('/register', [AuthController::class, 'register']);
$app->router->post('/register', [AuthController::class, 'register']);
$app->router->get('/login', [AuthController::class, 'login']);
$app->router->post('/login', [AuthController::class, 'login']);
$app->router->get('/forgot-password', [AuthController::class, 'forgotPassword']);
$app->router->post('/forgot-password', [AuthController::class, 'forgotPassword']);

$app->router->get('/', [SiteController::class, 'home']);
$app->router->get('/blog/{id:\w+}', [SiteController::class, 'blog']);
$app->router->get('/topics/{id:\w+}', [SiteController::class, 'topics']);
$app->router->get('/user/{username}', [SiteController::class, 'user']);

/** Admin Routes */
$app->router->get('/admin', [AdminController::class, 'dashboard']);

$app->run();