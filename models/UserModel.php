<?php

/**
 * UserModel Class
 * 
 * @author Celio Natti <celionatti@gmail.com>
 * @copyright 2023 Celionatti
 */

namespace app\models;

use app\core\Model;

abstract class UserModel extends Model
{
    abstract public function getDisplayName(): string;
}