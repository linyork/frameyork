<?php
\spl_autoload_register(function($className)
{
    try
    {
        $fileName = ROOT_PATH . '/' . \str_replace('\\', '/', $className) . '.php';
        if ( ! \is_file($fileName) )
        {
            throw new \Exception("$fileName  Class Not Exists...");
        }
        require_once $fileName;
    }
    catch ( \Exception $e )
    {
        \header('HTTP/1.1 500 Internal Server Error');
        if(DEBUG)
        {
            exit($e->getMessage());
        }
    }
});