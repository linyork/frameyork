<?php

namespace Core;

class Route
{
    private static $routingTable = [];

    /**
     * add 增加routing
     *
     * @param string $url
     * @param string $className
     * @param string $functionName
     *
     * @throws \Exception
     *
     * @author Heat <hitgunlai@gmail.com>
     */
    public static function add( string $url, string $controllerName, string $functionName ) : void
    {
        if ( isset(static::$routingTable[$url]) )
        {
            throw new \Exception('Routing Duplicate : ' . $url);
        }

        static::$routingTable[$url] = [$controllerName, $functionName];
    }

    /**
     * getRoutingTable
     *
     * @return array
     *
     * @author Heat <hitgunlai@gmail.com>
     */
    public static function getRoutingTable() : array
    {
        return static::$routingTable;
    }

    /**
     * getRouting
     *
     * @return array
     *
     * @throws \Exception
     *
     * @date  2018-03-26
     * @author Heat <hitgunlai@gmail.com>
     */
    private static function getRouting() : array
    {
        // 抓取 Request Path 資料
        $pathArray  = \Core\Request::getUrlPathArray();
        $pathString = \Core\Request::getUrlPathString();

        // 儲存 function 參數
        $arguments = [];

        // 儲存 routing 搜索結果
        $routing = [];

        // 判斷 Request Path
        if ( empty($pathArray) )
        {
            if ( ! isset(static::$routingTable['index']) )
            {
                throw new \Exception('Default Route "index" Not Found');
            }

            $routing['controllerName']  = static::$routingTable['index'][0];
            $routing['functionName']    = static::$routingTable['index'][1];
        }
        else
        {
            foreach ( $pathArray as $v )
            {
                if ( isset(static::$routingTable[$pathString]) )
                {
                    $routing['controllerName']  = static::$routingTable[$pathString][0];
                    $routing['functionName']    = static::$routingTable[$pathString][1];
                    break;
                }

                \array_unshift($arguments, \array_pop($pathArray));
                $pathString = \implode('/', $pathArray);
            }
        }

        if ( empty($routing['controllerName']) || empty($routing['functionName']) )
        {
            throw new \Exception('Route Not Found : ' . \Core\Request::getUrlPathString());
        }

        $routing['arguments'] = $arguments;

        return $routing;
    }

    /**
     * dispath
     *
     * @throws \Exception
     *
     * @author Heat <hitgunlai@gmail.com>
     */
    public static function dispath() : void
    {
        $routing = static::getRouting();

        $className    = '\\Application\\' . $routing['controllerName'];
        $functionName = $routing['functionName'];
        $arguments    = $routing['arguments'];

        if ( ! \class_exists($className) )
        {
            throw new \Exception('Action "' . $className . '" Class Not Exist');
        }

        if ( ! \method_exists($className, $functionName) )
        {
            throw new \Exception('Action "' . $className . '::' . $functionName . '()" Not Exist');
        }

        $classReflectionMethod = new \ReflectionMethod($className, $functionName);
        if ( \count($arguments) < $classReflectionMethod->getNumberOfRequiredParameters() )
        {
            throw new \Exception('Action "' . $className . '::' . $functionName . '()" number of required parameters inconsistent');
        }

        $app = new $className();
        \call_user_func_array(array($app, $functionName), $arguments);
    }
}
