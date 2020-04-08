<?php

namespace App\Traits;

trait FirstLetterStringUpper {
    static function letterUpper($str)
    {
        return mb_strtoupper (mb_substr($str, 0, 1)) . mb_substr($str, 1);
    }
}
