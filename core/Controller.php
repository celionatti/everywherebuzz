<?php

namespace app\core;

use app\core\Application;
use app\core\middlewares\BaseMiddleware;

/**
 * Class Controller
 * @author Celio Natti <celionatti@gmail.com>
 * @package app\core
 */

class Controller
{
    public string $layout = "main";
    public string $action = "";

    /** @var \app\core\middlewares\BaseMiddleware[] */
    public array $middlewares = [];

    public function __construct()
    {
        $this->onConstruct();
    }

    public function setLayout($layout)
    {
        $this->layout = $layout;
    }

    public function render($view, $params = [])
    {
        return Application::$app->view->renderView($view, $params);
    }

    public function registerMiddleware(BaseMiddleware $middleware)
    {
        $this->middlewares[] = $middleware;
    }

    /**
     * Summary of getMiddlewares
     * @return \app\core\middlewares\BaseMiddleware[]
     */
    public function getMiddlewares(): array
    {
        return $this->middlewares;
    }

    public function onConstruct()
    {
    }
}