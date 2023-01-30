<?php

/**
 * User: Celio Natti
 * Date: 20/12/2022
 * Time: 02:38 AM
 */

namespace app\core\middlewares;

use app\core\Application;
use app\core\exception\ForbiddenException;

/**
 * Class BaseMiddleware
 * @author celio natti <celionatti@gmail.com>
 * @package app\core\middlewares
 */

class AuthMiddleware extends BaseMiddleware
{
    protected array $actions = [];

    public function __construct($actions = [])
    {
        $this->actions = $actions;
    }

    public function execute()
    {
        if (Application::isGuest()) {
            if (empty($this->actions) || in_array(Application::$app->controller->action, $this->actions)) {
                throw new ForbiddenException();
            }
        }
    }
}