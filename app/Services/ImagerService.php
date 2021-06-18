<?php

namespace App\Services;

abstract class ImagerService {
    protected static $hotel = "com.br";
    protected static $startUrl = "https://www.habbo.%s/habbo-imaging/avatarimage?user=%s&%s";

    public static function make(String $username, String $querys)
    {
        return sprintf(
            self::$startUrl, self::$hotel, $username, $querys
        );
    }
}