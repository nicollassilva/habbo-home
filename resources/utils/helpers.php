<?php

use App\Models\Home\Item;
use App\Services\ImagerService;

if (!function_exists('imager')) {
    function imager(String $username, String $querys)
    {
        return ImagerService::make($username, $querys);
    }
}

if (!function_exists('widget')) {
    function widget(Item $item)
    {
        return app(App\Services\WidgetServices::class)->make($item);
    }
}

if (!function_exists('string_time')) {
    function string_time($time)
    {
        $etime = time() - $time;
        if ($etime < 1) {
            return '1 segundo';
        } else {
            $a = array(
                365 * 24 * 60 * 60  =>  'ano',
                30 * 24 * 60 * 60  =>  'mês',
                24 * 60 * 60  =>  'dia',
                60 * 60  =>  'hora',
                60  =>  'minuto',
                1  =>  'segundo'
            );

            $a_plural = array(
                'ano'   => 'anos',
                'mês'  => 'meses',
                'dia'    => 'dias',
                'hora'   => 'horas',
                'minuto' => 'minutos',
                'segundo' => 'segundos'
            );

            foreach ($a as $secs => $str) {
                $d = $etime / $secs;
                if ($d >= 1) {
                    $r = round($d);
                    return "há <b>{$r}</b> " . ($r > 1 ? $a_plural[$str] : $str) . " atrás";
                }
            }
        }
    }
}
