<?php

namespace Kernel;

class Request
{
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
        // 取得 request
        $requestUri = \parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        //去除開頭的 '/'
        $requestUriRemoveHead =\substr($requestUri,1);

        //轉陣列
        $requestUriArray = \explode('/',$requestUriRemoveHead);

        //去除空陣列回傳
        return \array_filter($requestUriArray);
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
        return \implode('/', \Kernel\Request::getUrlPathArray());
    }

}