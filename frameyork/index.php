<?php
// 載入核心
require_once "./../../System/Kernel/Kernel.php";
/*
 *---------------------------------------------------------------
 * 設定 SITE PATH
 *---------------------------------------------------------------
 */
// 設定 ROOT PATH
\define('ROOT_PATH', __DIR__);
// 設定 CONFIG PATH
\define('CONFIG_PATH', ROOT_PATH . '/Config');
try
{
    /*
     *---------------------------------------------------------------
     * Request
     *---------------------------------------------------------------
     *
     *  取得 Request
     */
    $request = \Kernel\Request::getUrlPathArray();
    /*
     *---------------------------------------------------------------
     * Route 解析
     *---------------------------------------------------------------
     *
     *  將 Request 派給 Route 處理
     */
    \Kernel\Route::dispath($request);
}
catch (\Exception $e)
{
    if(DEBUG)
    {
        exit($e->getMessage());
    }
    header('HTTP/1.1 500 Internal Server Error');
}





