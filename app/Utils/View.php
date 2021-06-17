<?php

namespace App\Utils;

use Jenssegers\Blade\Blade;

abstract class View {
    /** @var object */
    protected static $bladeInstance;
    
    /**
     * Method responsible to instance
     * a Blade template engine.
     * 
     * @return void
     */
    public static function initBlade()
    {
        if(self::$bladeInstance instanceof Blade) return;

        $rootPath = dirname(__DIR__, 2);

        $ds = DIRECTORY_SEPARATOR;

        $completePath = "{$rootPath}{$ds}resources{$ds}";

        self::$bladeInstance = new Blade("{$completePath}views", "{$completePath}cache");
    }

    public static function render(String $view, Array $data = [], Array $mergedData = [])
    {
        self::initBlade();

        echo self::$bladeInstance->render($view, $data, $mergedData);
    }
}
