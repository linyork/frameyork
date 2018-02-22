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
            // 取得 routingTable : array
            $routingTable = \Config\RoutingTable::getRoutingTable();

            // 計算 request 陣列數目
            $countRequests = \count($request);

            // 判斷 request 是否有相對應的 routingTable
            $filter_root = ($countRequests == 0) ? ! \array_key_exists('', $routingTable) : self::NOT_EXIST;

            $filter_one = ($countRequests == 1) ? ! \array_key_exists($request[0], $routingTable) : self::NOT_EXIST;

            $filter_two = ($countRequests >= 2) ? ! \array_key_exists($request[0] . "/" . $request[1], $routingTable) : self::NOT_EXIST;

            if ( $filter_root && $filter_one && $filter_two )
            {
                throw new \Exception($_SERVER['HTTP_HOST'] . "/" . \Kernel\Request::getUrlPathString() . ' Not Exist');
            }

            // 依照 request 陣列數目 return routingTable 裡的 class Name 或是 function Name
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
            \header('HTTP/1.1 404 Not Found');
            if ( DEBUG )
            {
                exit ($e->getMessage());
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
        // 取得該 dispath 的  class Name, function Name, argument
        $className        = self::routingTable(\Kernel\Route::CLASS_INDEX, $request);
        $functionName     = self::routingTable(\Kernel\Route::FUNCTION_INDEX, $request);
        $functionArgument = self::getFunctionArgument($request);

        // 執行dispath
        try
        {
            // 判斷該 class Name 是否存在
            if ( ! \class_exists($className) )
            {
                throw new \Exception('Action "' . $className . '" Class Not Exist');
            }

            // 判斷該 function Name 是否存在
            if ( ! \method_exists($className, $functionName) )
            {
                throw new \Exception('Action "' . $className . '::' . $functionName . '()" Not Exist');
            }

            // 判斷該 function 的 argument 的 參數數量是合理
            $classReflectionMethod = new \ReflectionMethod($className, $functionName);
            if ( \count($functionArgument) > $classReflectionMethod->getNumberOfParameters() )
            {
                throw new \Exception('Action "' . $className . '::' . $functionName . '()" number of parameters inconsistent');
            }

            $app = new $className();
            \call_user_func_array(array($app, $functionName), $functionArgument);
        }
        catch ( \Exception $e )
        {
            \header('HTTP/1.1 404 Not Found');
            if ( DEBUG )
            {
                exit ($e->getMessage());
            }
        }
    }
}
