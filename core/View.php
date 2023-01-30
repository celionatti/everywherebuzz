<?php

/**
 * User: Celio Natti
 * Date: 30/01/2023
 * Time: 05:13 PM
 */

namespace app\core;

/**
 * Class View
 *
 * @author celio natti <celionatti@gmail.com>
 * @package app\core
 */

class View
{
    public string $title = "";

    public function renderView($view, $params = [])
    {
        $viewContent = $this->renderOnlyView($view, $params);
        $layoutContent = $this->layoutContent();
        return str_replace('{{content}}', $viewContent, $layoutContent);
    }

    public function renderContent($viewContent)
    {
        $layoutContent = $this->layoutContent();
        return str_replace('{{content}}', $viewContent, $layoutContent);
    }

    protected function layoutContent()
    {
        $layout = Application::$app->layout;

        if (Application::$app->controller) {
            $layout = Application::$app->controller->layout;
        }
        ob_start();
        require_once Application::$ROOT_DIR . "/views/layouts/$layout.php";
        return ob_get_clean();
    }

    public function renderOnlyView($view, $params)
    {
        foreach ($params as $key => $value) {
            $$key = $value;
        }
        ob_start();
        require_once Application::$ROOT_DIR . "/views/$view.php";
        return ob_get_clean();
    }

    public function partials($view)
    {
        require_once Application::$ROOT_DIR . "/views/partials/$view.php";
    }

    public function component($component)
    {
        require_once Application::$ROOT_DIR . "/views/$component.php";
    }

}