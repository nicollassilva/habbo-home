<?php

namespace App\Utils;

use Exception;

class View {
    
    /**
     * @param string $view
     * @param array $resources
     */
    public function view(String $view, Array $resources = [])
    {
        $filePath = $this->getDirectory($view);
        
        if(!file_exists($filePath)) {
            throw new Exception("View [{$view}] doesn't exists.", 500);
        }
        
        if($resources != null) {
            extract($resources, EXTR_PREFIX_SAME, "wddx");
        }

        require_once $filePath;
    }

    /**
     * @param string $file
     * @return string
     */
    public function getDirectory(String $file): String
    {
        $ds = DIRECTORY_SEPARATOR;

        $fileDirectory = str_replace('.', $ds, $file);

        return dirname(__DIR__, 2) . "{$ds}resources{$ds}views{$ds}{$fileDirectory}.php";
    }

    public static function __callStatic($name, $arguments)
    {
        if($name === 'render') {
            return (new static)->view($arguments[0], $arguments[1]);
        }
    }
}
