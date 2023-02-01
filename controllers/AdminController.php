<?php

/** User: Celio Natti ***/

namespace app\controllers;

use app\core\Request;
use app\core\Controller;

/**
 * Class AdminController
 *
 * @author celio natti <celionatti@gmail.com>
 * @package app\controllers
 */

class AdminController extends Controller
{
    public function onConstruct()
    {
        $this->setLayout('admin');
    }

    public function dashboard()
    {
        $params = [];

        return $this->render('admin/dashboard', $params);
    }

}