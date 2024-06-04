<?php


namespace App\System\Helpers;


class AppHelper
{
    public static function getAppPath()
    {
        return realpath(__DIR__);
    }
}
