<?php
/**
 * Composer Autoload
 */
require_once(__DIR__.'/../vendor/autoload.php');

/**
 *---------------------------------------------------------------
 * Autoload
 *---------------------------------------------------------------
 */
\spl_autoload_register(function ( $className )
{
    try
    {
        static $systemNameSpace = array('Core', 'Library', 'Model');

        $path      = SYSTEM_PATH;
        $nameSpace = \strstr($className, '\\', true);
        if ( ! $nameSpace || ! \in_array($nameSpace, $systemNameSpace) )
        {
            $path = ROOT_PATH;
        }

        $fileName = $path . '/' . \str_replace('\\', '/', $className) . '.php';
        if ( ! \is_file($fileName) )
        {
            throw new \Exception("$fileName Class Not Exists ");
        }
        require_once $fileName;
    }
    catch ( \Exception $e )
    {
        if ( DEBUG )
        {
            exit($e->getMessage());
        }
        \header('HTTP/1.1 500 Internal Server Error');
    }
});