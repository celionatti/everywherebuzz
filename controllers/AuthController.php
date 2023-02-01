<?php

/** User: Celio Natti ***/

namespace app\controllers;

use app\core\Request;
use app\core\Controller;

/**
 * Class AuthController
 *
 * @author celio natti <celionatti@gmail.com>
 * @package app\controllers
 */

class AuthController extends Controller
{
    public function onConstruct()
    {
        $this->setLayout('auth');
    }

    public function register()
    {
        $params = [];

        return $this->render('auth/register', $params);
    }

    public function login()
    {
        $params = [];

        return $this->render('auth/login', $params);
    }

    public function forgotPassword()
    {
        $params = [];

        return $this->render('auth/forgot-password', $params);
    }

}