<?php

/** User: Celio Natti ***/

namespace app\controllers;

use app\models\Users;
use app\core\Controller;

/**
 * Class SiteController
 *
 * @author celio natti <celionatti@gmail.com>
 * @package app\controllers
 */

 class SiteController extends Controller
 {
    public function home()
    {
        $params = [
            'name' => "Celionation",
        ];

        return $this->render('home', $params);
    }

 }
