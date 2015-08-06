<?php

/**
 * Global configurations
 */
clearstatcache();

$GLOBALS['config'] = [
            'db' => [
                'mysql' => [
                    'host' => '127.0.0.1',
                    'user' => 'root',
                    'pass' => '',
                    'db'   => 'app_pdo',
                ],
            ],
        ];

function auto_loader($classname)
{
    $path = '';
    
    if(is_file("Repos/".$classname.".php"))
    {
        $path = "Repos/".$classname.".php";
    }
    else if(is_file("classes/".$classname.".php"))
    {
        $path = "classes/".$classname.".php";
    }
    else if(is_file("Models/".$classname.".php"))
    {
        $path = "Models/".$classname.".php";
    }
    else
    {
        throw new Exception(" this $classname is not found");
    }
    require_once $path;
}
spl_autoload_register('auto_loader');