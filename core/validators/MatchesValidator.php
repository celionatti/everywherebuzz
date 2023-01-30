<?php

namespace app\core\validators;

class MatchesValidator extends Validator
{
    public function runValidation()
    {
        $value = $this->_obj->{$this->field};
        return $value == $this->rule;
    }
}