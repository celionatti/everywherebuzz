<?php

/** User: Celio Natti ***/

namespace app\controllers;

use app\core\Request;
use app\core\Session;
use app\models\Users;
use app\core\Response;
use app\core\Controller;
use app\core\helpers\Bcrypt;
use app\core\middlewares\AuthMiddleware;

/**
 * Class AuthController
 *
 * @author celio natti <celionatti@gmail.com>
 * @package app\controllers
 */

class AuthController extends Controller
{
    use Bcrypt;
    
    public function onConstruct()
    {
        $this->setLayout('auth');
        // $this->registerMiddleware(new AuthMiddleware(['register', 'login']));
    }

    public function register(Request $request, Response $response)
    {
        $user = new Users();

        if ($request->isPost()) {
            $session = new Session();
            $session->csrfCheck();
            $user->loadData($request->getBody());
            $user->username = $user->surname . "_" . $user->lastname;
            $user->validateRegistration();

            if (isset($_GET['ref'])) {
                $user->refer_by = $request->esc($_GET['ref']);
            }
            if ($user->save()) {
                $session->setFlash("success", "Registration successful, please check your E-mail for verification.");
                $response->redirect('/login');
            }
        }

        $params = [];

        return $this->render('auth/register', $params);
    }

    public function login(Request $request, Response $response)
    {
        $user = new Users();
        $isError = true;

        if($request->isPost()) {
            $session = new Session();
            $session->csrfCheck();
            $user->loadData($request->getBody());
            $user->validateLogin();
            if(empty($user->getErrors())) {
                // check if user exists.
                $u = Users::findFirst(
                    [
                        'conditions' => "email = :email",
                        'bind' => ['email' => $request->getReqBody('email')]
                    ]
                );
                //compare user input password with user Model password.
                if ($u) {
                    $verified = $this->comparePassword($user->password, $u->password);
                    if ($verified) {
                        // Login User
                        $isError = false;
                        $remember = $request->getReqBody('remember') == 'on';
                        $u->login($remember);
                        $response->redirect('/');
                    }
                }
            }
            if($isError) {
                $session->setFlash("error", "Something is wrong with the Email or Password. Please try again.");
            }
        }

        $params = [
            
        ];

        return $this->render('auth/login', $params);
    }

    public function forgotPassword()
    {
        $params = [];

        return $this->render('auth/forgot-password', $params);
    }

}