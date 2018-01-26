<?php
namespace App\Model\Validation;

use Cake\Validation\Validation;

class CustomValidation extends Validation
{
    /**
     * 空白文字判定
     *
     * @param string $value
     * @return bool
     */
    public static function isSpace($value)
    {
        return (bool) preg_match('/[^\s　]/', $value);
    }
    
}
