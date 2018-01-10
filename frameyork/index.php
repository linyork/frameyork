<?php
// 載入核心
require_once "./Kernel/Kernel.php";
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





