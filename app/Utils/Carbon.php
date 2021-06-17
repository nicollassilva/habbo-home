<?php

namespace App\Utils;

use Carbon\Carbon as CarbonOriginal;

final class Carbon extends CarbonOriginal
{
    public static function now($tz = 'America/Sao_Paulo')
    {
        return parent::now($tz);
    }
}