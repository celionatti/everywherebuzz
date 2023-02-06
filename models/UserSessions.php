<?php

/**
 * UserSessions class
 * 
 * @author Celio Natti <Celionatti@gmail.com>
 * @copyright 2023 CelioNatti
 */

namespace app\models;

use app\core\Model;

 class UserSessions extends Model
 {
    protected static $table = 'user_sessions';
    public $id, $user_id, $hash, $ip, $os, $browser, $device;
 }