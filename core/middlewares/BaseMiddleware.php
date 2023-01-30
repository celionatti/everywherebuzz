<?php

/**
 * User: Celio Natti
 * Date: 30/01/2023
 * Time: 05:40 PM
 */

namespace app\core\middlewares;

/**
* Class BaseMiddleware
* @author celio natti <celionatti@gmail.com>
* @package app\core\middlewares
*/

abstract class BaseMiddleware
{
    abstract public function execute();
}