<?php

namespace Kernel;

class Route
{
    const CLASS_INDEX    = 0;
    const FUNCTION_INDEX = 1;
    const NOT_EXIST      = 1;

    /*----------------------------------------------------------------------------------------------------------------*/
    protected static function routingTable(string $index, array $request) : string
    {
        try
        {
            $routingTable = \Config\RoutingTable::getRoutingTable();

            $countRequests = \count($request);

            $filter_root = ($countRequests == 0) ? ! \array_key_exists('', $routingTable) : self::NOT_EXIST;

            $filter_one = ($countRequests == 1) ? ! \array_key_exists($request[0], $routingTable) : self::NOT_EXIST;

            $filter_two = ($countRequests >= 2) ? ! \array_key_exists($request[0] . "/" . $request[1], $routingTable) : self::NOT_EXIST;

            if ( $filter_root && $filter_one && $filter_two )
            {
                throw new \Exception($_SERVER['HTTP_HOST'] . "/" . \Kernel\Request::getUrlPathString() . ' Not Exist');
            }

            switch ( $countRequests )
            {
                case '0':
                    return $routingTable[""][$index];
                    break;

                case '1':
                    return $routingTable[$request[0]][$index];
                    break;

                default:
                    return $routingTable[$request[0] . "/" . $request[1]][$index];
                    break;
            }
        }
        catch ( \Exception $e )
        {
            if ( DEBUG )
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
        $className        = self::routingTable(\Kernel\Route::CLASS_INDEX, $request);
        $functionName     = self::routingTable(\Kernel\Route::FUNCTION_INDEX, $request);
        $functionArgument = self::getFunctionArgument($request);

        try
        {
            if ( ! \class_exists($className) )
            {
                throw new \Exception('Action "' . $className . '" Class Not Exist');
            }

            if ( ! \method_exists($className, $functionName) )
            {
                throw new \Exception('Action "' . $className . '::' . $functionName . '()" Not Exist');
            }

            $classReflectionMethod = new \ReflectionMethod($className, $functionName);
            if ( \count($functionArgument) > $classReflectionMethod->getNumberOfParameters() )
            {
                throw new \Exception('Action "' . $className . '::' . $functionName . '()" number of parameters inconsistent');
            }
        }
        catch ( \Exception $e )
        {
            if ( DEBUG )
            {
                \header('HTTP/1.1 404 Not Found');
                echo $e->getMessage();
                exit;
            }
        }

        $app = new $className();
        \call_user_func_array(array($app, $functionName), $functionArgument);
    }
}
