<?php

spl_autoload_register('autoloader');

function autoloader($className)
{
    $classFilePath = str_replace("\\", DIRECTORY_SEPARATOR, $className);
    $classFilePath.= '.php';
    if (file_exists($classFilePath) && is_readable($classFilePath)) {
        include_once __DIR__.DIRECTORY_SEPARATOR.$classFilePath;
    }
}

