<?php

require dirname(__DIR__).'/vendor/autoload.php';

spl_autoload_register(function ($classname) {
    $filename = __DIR__.'/'.str_replace('\\', '/', $classname).'.php';
    if (file_exists($filename)) {
        require $filename;
    }
});
