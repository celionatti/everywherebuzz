<?php

/** User: Celio Natti ***/

namespace app\core;

/**
 * Class Session
 *
 * @author celio natti <celionatti@gmail.com>
 * @package app\core
 */

class Session
{
    protected const FLASH_KEY = 'flash_messages';

    public function __construct()
    {
        $this->start_session();

        $flashMessages = $_SESSION[self::FLASH_KEY] ?? [];
        foreach ($flashMessages as $key => &$flashMessage) {
            /** Mark to be removed. */
            $flashMessage['remove'] = true;
        }
        $_SESSION[self::FLASH_KEY] = $flashMessages;
    }

    /** activate session if not yet started **/
    private static function start_session(): int
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        return 1;
    }

    public function setFlash($key, $message)
    {
        $_SESSION[self::FLASH_KEY][$key] = [
            'remove' => false,
            'value' => $message
        ];
    }

    public function getFlash($key)
    {
        return $_SESSION[self::FLASH_KEY][$key]['value'] ?? false;
    }

    public function exists($name)
    {
        $this->start_session();

        return isset($_SESSION[$name]);
    }

    public function set($key, $value)
    {
        $this->start_session();

        $_SESSION[$key] = $value;
    }

    public function get($key)
    {
        $this->start_session();

        if ($this->exists($key) && !empty($_SESSION[$key])) {
            return $_SESSION[$key];
        }
        return false;
    }

    public function remove($key)
    {
        $this->start_session();

        unset($_SESSION[$key]);
    }

    public static function createCsrfToken()
    {
        $token = bin2hex(random_bytes(12));
        self::set('_token', $token);
        return $token;
    }

    public static function csrfCheck()
    {
        $request = new Request();
        $check = $request->post('_token');
        if (self::exists('_token') && self::get('_token') == $check) {
            return true;
        }
        Application::$app->response->redirect('errors/403');
    }

    public function __destruct()
    {
        /** Iterate over Mark to be removed. */
        $this->removeFlashMessages();
    }

    public function removeFlashMessages()
    {
        $flashMessages = $_SESSION[self::FLASH_KEY] ?? [];
        foreach ($flashMessages as $key => $flashMessage) {
            if ($flashMessage['remove']) {
                unset($flashMessages[$key]);
            }
        }
        $_SESSION[self::FLASH_KEY] = $flashMessages;
    }

}