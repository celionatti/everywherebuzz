<?php

/**
 * User: Celio Natti
 * Date: 30/01/2023
 * Time: 01:52 PM
 */

namespace app\core\exceptions;


/**
 * Class ForbiddenException
 * @author celio natti <celionatti@gmail.com>
 * @package app\core\exceptions
 */

class NotFoundException extends \Exception
{
    protected $message = 'Page not found';
    protected $code = 404;
}