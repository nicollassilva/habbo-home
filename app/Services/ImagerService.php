<?php

namespace App\Services;

abstract class ImagerService
{
    protected static $hotel = "com.br";
    protected static $startUrl = "https://www.habbo.%s/habbo-imaging/avatarimage?user=%s&%s";

    /**
     * Builds the url of the habbo imager 
     * and returns it.
     * 
     * @param string $username
     * @param string $querys
     * 
     * @return string
     */
    public static function make(String $username, String $querys): String
    {
        return sprintf(
            self::$startUrl, self::$hotel, $username, $querys
        );
    }
}