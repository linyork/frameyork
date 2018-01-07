<?php

namespace Kernel;

class Route
{
    const CLASSMAP    = 0;
    const FUNCTIONMAP = 1;

    protected static function routingTable(string $map, array $request) : string
    {
        $routingTable = array(
            "test/echotest" => array("\Application\Test", "echoTest")
        );

        if ( ! \array_key_exists($request[0] . "/" . $request[1], $routingTable) )
        {
            \header('HTTP/1.1 404 Not Found');
            throw new \Exception('Action "' . $request[0] . '::' . $request[1] . '()" Not Exist');
        }
        return $routingTable[$request[0] . "/" . $request[1]][$map];
    }

    protected static function getFunctionArgument($request) : array
    {
        $argument = $request;
        unset($argument[0], $argument[1]);
        return \array_values($argument);
    }

    /**
     * dispath
     *
     * @param $request
     * @date   2018/1/7
     * @author York <jason945119@gmail.com>
     */
    public static function dispath($request) : void
    {
        $className    = self::routingTable(\Kernel\Route::CLASSMAP, $request);
        $functionName = self::routingTable(\Kernel\Route::FUNCTIONMAP, $request);

        if ( ! \method_exists($className, $functionName) )
        {
            \header('HTTP/1.1 404 Not Found');
            throw new \Exception('Action "' . $className . '::' . $functionName . '()" Not Exist');
        }

        $app = new $className();

        \call_user_func_array(array($app, $functionName), self::getFunctionArgument($request));
    }
}
