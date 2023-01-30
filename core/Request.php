<?php

/**
 * Router Class
 * 
 * @author Celio Natti <celionatti@gmail.com>
 * @copyright 2023 Celionatti
 */

namespace app\core;


class Request
{
    private array $routeParams = [];

    public function getPath()
    {
        $path = $_SERVER['REQUEST_URI'] ?? '/';
        $position = strpos($path, '?');
        if ($position === false) {
            return $path;
        }
        return substr($path, 0, $position);
    }

    public function method()
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    public function isGet()
    {
        return $this->method() === 'get';
    }

    public function isPost()
    {
        return $this->method() === 'post';
    }

    public function isPut()
    {
        return $this->method() === 'put';
    }

    public function isPatch()
    {
        return $this->method() === 'patch';
    }

    public function isDelete()
    {
        return $this->method() === 'delete';
    }

    public function getBody()
    {
        $body = [];
        if ($this->method() === 'get') {
            foreach ($_GET as $key => $value) {
                $body[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
        if ($this->method() === 'post') {
            foreach ($_POST as $key => $value) {
                $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
        return $body;
    }

    /** get a value from the POST variable **/
    public function post(string $key = '', mixed $default = ''): mixed
    {

        if (empty($key)) {
            return $_POST;
        } elseif (isset($_POST[$key])) {
            return $_POST[$key];
        }

        return $default;
    }

    /** get a value from the FILES variable **/
    public function files(string $key = '', mixed $default = ''): mixed
    {

        if (empty($key)) {
            return $_FILES;
        } elseif (isset($_FILES[$key])) {
            return $_FILES[$key];
        }

        return $default;
    }

    /** get a value from the GET variable **/
    public function get(string $key = '', mixed $default = ''): mixed
    {

        if (empty($key)) {
            return $_GET;
        } elseif (isset($_GET[$key])) {
            return $_GET[$key];
        }

        return $default;
    }

    public function getReqBody($input = false)
    {
        if (!$input) {
            $data = [];
            foreach ($_REQUEST as $field => $value) {
                $data[$field] = self::sanitize($value);
            }
            return $data;
        }
        return array_key_exists($input, $_REQUEST) ? self::sanitize($_REQUEST[$input]) : false;
    }

    public static function sanitize($dirty)
    {
        return $dirty;
    }

    /**
     * @param $params
     * @return self
     */
    public function setRouteParams($params)
    {
        $this->routeParams = $params;
        return $this;
    }

    public function getRouteParams()
    {
        return $this->routeParams;
    }

    public function getRouteParam($param, $default = null)
    {
        return $this->routeParams[$param] ?? $default;
    }
}