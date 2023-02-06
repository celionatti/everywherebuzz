<?php

/** User: Celio Natti ***/

namespace app\core;

use app\core\database\DbModel;

/**
 * Class Model
 *
 * @author celio natti <celionatti@gmail.com>
 * @package app\core
 */

class Model extends DbModel
{
    public function loadData($data)
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
    }
}