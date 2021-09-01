<?php

spl_autoload_register(function ($className) {

    $className = ltrim($className, '\\');
    $fileName  = '';
    $namespace = '';

    if ($lastNsPos = strrpos($className, '\\')) {
        $namespace = strtolower(substr($className, 0, $lastNsPos));
        $className = substr($className, $lastNsPos + 1);
        $fileName  = str_replace('\\', '/', $namespace) . '/';
    }
    $fileName .= str_replace('_', '/', $className) . '.php';
    require  $fileName;
});