<?php

function initiate($className) {
    $fileName = '';
    $namespace = '';

    if (false !== ($lastNamespacePosition = strripos($className, '\\'))) {
        $namespace = substr($className, 0, $lastNamespacePosition);
        $className = substr($className, $lastNamespacePosition + 1);
        $fileName = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
    }

    require includePathStrategy($fileName . getFileName($className));
}

function getFileName($className)
{
    return str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';
}

function includePathStrategy($fileName)
{
    $basePath = dirname(__FILE__) . DIRECTORY_SEPARATOR;
    $modulesPath = $basePath . 'modules';
    $vendorPath = $basePath . 'vendor';

    $fullFileNameModules = $modulesPath . DIRECTORY_SEPARATOR . $fileName;
    $fullFileNameVendor = $vendorPath . DIRECTORY_SEPARATOR . $fileName;

    if (file_exists($fullFileNameModules)) {
        return $fullFileNameModules;

    } elseif (file_exists($fullFileNameVendor)) {
        return $fullFileNameVendor;

    } else {
        echo 'A classe "' . $fileName . '" não existe ou não foi encontrada.';
    }
}

spl_autoload_register('initiate');
