<?php

/** User: Celio Natti ***/

namespace app\controllers;

use app\core\Request;
use app\core\Controller;
use app\core\helpers\Token;

/**
 * Class SiteController
 *
 * @author celio natti <celionatti@gmail.com>
 * @package app\controllers
 */

 class SiteController extends Controller
 {
    public function onConstruct()
    {
        $this->setLayout('main');
    }

    public function home()
    {
        $params = [];
        
        return $this->render('home', $params);
    }

    public function blog(Request $request)
    {
        dump($request->getRouteParams());
        $params = [];

        return $this->render('blog', $params);
    }

    public function topics()
    {
        $params = [];

        return $this->render('topics', $params);
    }

    public function user(Request $request)
    {
        $params = [];

        return $this->render('user', $params);
    }

 }
