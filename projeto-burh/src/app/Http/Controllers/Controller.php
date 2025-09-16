<?php

namespace App\Http\Controllers;

abstract class Controller
{
    public function validarStringUtf8($string) {
        if (!mb_check_encoding($string, 'UTF-8')) {
            return mb_convert_encoding($string, 'UTF-8', 'ISO-8859-1');
        }
        return $string;
    }
}
