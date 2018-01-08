<?php

namespace Kernel;

class Route
{
    const CLASS_INDEX    = 0;
    const FUNCTION_INDEX = 1;
    /*----------------------------------------------------------------------------------------------------------------*/
    protected static function routingTable(string $map, array $request) : string
    {
        try
        {
            $routingTable = \Config\RoutingTable::getRoutingTable();
            if ( ! \array_key_exists($request[0] . "/" . $request[1], $routingTable) )
            {
                throw new \Exception('Action "' . $request[0] . '::' . $request[1] . '()" Not Exist');
            }
            return $routingTable[$request[0] . "/" . $request[1]][$map];
        }
        catch ( \Exception $e )
        {
            if(DEBUG)
            {
                \header('HTTP/1.1 404 Not Found');
                echo $e->getMessage();
                exit;
            }
        }
    }

    protected static function getFunctionArgument($request) : array
    {
        $argument = $request;
        unset($argument[0], $argument[1]);
        return \array_values($argument);
    }
    /*----------------------------------------------------------------------------------------------------------------*/
    /**
     * dispath
     *
     * @param $request
     * @date   2018/1/7
     * @author York <jason945119@gmail.com>
     */
    public static function dispath($request) : void
    {
        $className    = self::routingTable(\Kernel\Route::CLASS_INDEX, $request);
        $functionName = self::routingTable(\Kernel\Route::FUNCTION_INDEX, $request);

        try
        {
            if ( ! \method_exists($className, $functionName) )
            {
                throw new \Exception('Action "' . $className . '::' . $functionName . '()" Not Exist');
            }
        }
        catch ( \Exception $e )
        {
            if(DEBUG)
            {
                \header('HTTP/1.1 404 Not Found');
                echo $e->getMessage();
                exit;
            }
        }

        $app = new $className();
        \call_user_func_array(array($app, $functionName), self::getFunctionArgument($request));
    }
}
