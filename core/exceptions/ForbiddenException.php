<?php

/**
 * User: Celio Natti
 * Date: 30/01/2023
 * Time: 05:50 PM
 */

namespace app\core\exception;


/**
 * Class ForbiddenException
 * @author celio natti <celionatti@gmail.com>
 * @package app\core\exception
 */

class ForbiddenException extends \Exception
{
    protected $message = 'You don\'t have permission to access this page';
    protected $code = 403;
}