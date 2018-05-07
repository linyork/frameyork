<?php
namespace Core;

class Config
{
    private static $env = null;
    private static $requestScheme = null;

    /**
     * initEnv
     *
     * @date 2018/3/12
     * @author Heat <hitgunlai@gmail.com>
     * @author York <jason945119@gmail.com>
     */
    private static function initEnv()
    {
        $env = '';

        // 判斷本地 server 環境變數 (der, prod 等)
        if( !empty($_SERVER['__CLI_CRONTAB_ENV']))
        {
            $env = $_SERVER['__CLI_CRONTAB_ENV'];
        }
        else if( !empty($_SERVER['NGINX_SERVER_ENV']) )
        {
            $env = $_SERVER['NGINX_SERVER_ENV'];
        }
        else
        {
            $env = (function ()
            {
                if ( empty($_SERVER['SERVER_NAME']) )
                {
                    throw new \Exception('SERVER_NAME Not Exists!');
                }

                $subDomain = strstr($_SERVER['SERVER_NAME'], '.', true);
                if(empty($subDomain))
                {
                    throw new \Exception('subDomain Not Exists!');
                }

                $envDash = strstr($subDomain, '-', true);
                if ( $envDash === false )
                {
                    return PROD;
                }

                return strtolower($envDash);
            })();
        }

        static::$env = $env;
    }

    /**
     * getEnvName
     * 取得環境變數
     *
     * @return string
     *
     * @date 2018/3/12
     * @author Heat <hitgunlai@gmail.com>
     */
    public static function getEnvName() :string
    {
        if(static::$env === null)
        {
            static::initEnv();
        }
        return static::$env;
    }

    /**
     * getRequestScheme
     * 取得 Request Scheme
     *
     * @return string
     *
     * @date 2018/3/12
     * @author Heat <hitgunlai@gmail.com>
     */
    public static function getRequestScheme() :string
    {
        if(static::$requestScheme === null)
        {
            $requestScheme = 'http';
            if (\Core\Request::isHttps() === true)
            {
                $requestScheme .= 's';
            }
            $requestScheme .= '://';
            static::$requestScheme = $requestScheme;
        }
        return static::$requestScheme;
    }

    /**
     * loadEnvFile
     * 載入環境設定檔
     *
     * @date 2018/3/12
     * @author Heat <hitgunlai@gmail.com>
     */
    public static function loadEnvFile()
    {
        $env = static::getEnvName();
        $envFile = ENV_FILE_PATH . '/' . $env . '.php';
        if(!is_file($envFile))
        {
            throw new \Exception('Config File Not Exists! Target File (' . $envFile . ')');
        }
        require_once $envFile;
    }
}