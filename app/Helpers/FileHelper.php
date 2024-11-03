<?php

namespace App\Helpers;

class FileHelper
{
    public static function get_file_url(?string $path = null)
    {
        return ($path) ? asset($path) : asset('site/images/major.jpg');
    }
}
