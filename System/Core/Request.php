<?php

namespace Core;

class Request
{
    private static $isPost = null;
    private static $urlPathArray = null;
    private static $urlPathString = null;

    /**
     * getUrlPath
     *
     * @return array
     *
     * @date   2018/1/5
     * @author York <jason945119@gmail.com>
     */
    public static function getUrlPathArray() : array
    {
        if(static::$urlPathArray === null)
        {
            // 取得 request
            $requestUri = \parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

            // 去除開頭的 '/'
            $requestUriRemoveHead = \substr($requestUri,1);

            // 轉陣列
            $requestUriArray = \explode('/',$requestUriRemoveHead);

            // 去除空陣列
            static::$urlPathArray = \array_filter($requestUriArray);
        }

        return static::$urlPathArray;
    }

    /**
     * getUrlPathString
     *
     * @return string
     *
     * @date   2018/1/5
     * @author York <jason945119@gmail.com>
     */
    public static function getUrlPathString() : string
    {
        if( static::$urlPathString === null)
        {
            // 將 Array 轉 String
            static::$urlPathString = \implode('/', static::getUrlPathArray());
        }

        return static::$urlPathString;
    }

    /**
     * isHttps
     *
     * @return bool
     *
     * @author Heat <hitgunlai@gmail.com>
     */
    public static function isHttps() : bool
    {
        // cloudflare 兼容
        if(isset($_SERVER['HTTP_CF_VISITOR']))
        {
            $visitor = json_decode($_SERVER['HTTP_CF_VISITOR'], true);
            if(isset($visitor['scheme']) && $visitor['scheme'] == 'https')
            {
                return true;
            }
        }

        // gcp 兼容
        if(isset($_SERVER['HTTP_X_FORWARDED_PROTO']))
        {
            if($_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')
            {
                return true;
            }
        }

        if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off')
        {
            return true;
        }

        return false;
    }

    /**
     * getRequestMethod
     *
     * @return string|null
     *
     * @author Heat <hitgunlai@gmail.com>
     */
    public static function getRequestMethod()
    {
        // Which request method was used to access the page; i.e. 'GET', 'HEAD', 'POST', 'PUT'.
        return $_SERVER['REQUEST_METHOD'] ?? null;
    }

    /**
     * isPost
     *
     * @return bool
     *
     * @author Heat <hitgunlai@gmail.com>
     */
    public static function isPost() : bool
    {
        if( static::$isPost === null )
        {
            static::$isPost = (static::getRequestMethod() === 'POST');
        }
        return static::$isPost;
    }
}