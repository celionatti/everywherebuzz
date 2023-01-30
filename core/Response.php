<?php

/**
 * Router Class
 * 
 * @author Celio Natti <celionatti@gmail.com>
 * @copyright 2023 Celionatti
 */

namespace app\core;

class Response
{
    public function setStatusCode($code)
    {
        http_response_code($code);
    }

    /**
     * Summary of redirect
     * @param mixed $url
     * @return void
     */
    public function redirect($url): void
    {
        if (!headers_sent()) {
            header("Location: $url");
        } else {
            echo '<script type="text/javascript">';
            echo 'window.location.href = "' . $url . '"';
            echo '</script>';
            echo '<script>';
            echo '<meta http-equiv="refresh" content="0;url=' . $url . '" />';
            echo '</script>';
        }
        exit();
    }

    public function lastUrl()
    {
        if (!headers_sent()) {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            die;
        }
    }

    public function jsonResponse($resp)
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        http_response_code(200);
        echo json_encode($resp);
        exit;
    }

}