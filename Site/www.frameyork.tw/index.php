<?php
// 載入核心
require_once "./../../System/Kernel/Kernel.php";
/*
 *---------------------------------------------------------------
 * 設定 SITE PATH
 *---------------------------------------------------------------
 *
 * 依環境選擇 SYSTEM 還是 SITE 的設定檔
 */
// 設定 Site ROOT PATH
\define('ROOT_PATH', __DIR__);

if ( ENV === 'dev' )
{
    \define('CONFIG_PATH', ROOT_PATH . '/Config');
}
if ( ENV === 'online' )
{
    \define('CONFIG_PATH', SYSTEM_PATH . '/Config');
}
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
        echo $e->getMessage();
        exit;
    }
    header('HTTP/1.1 500 Internal Server Error');
}





