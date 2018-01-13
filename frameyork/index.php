<?php
/*
 *---------------------------------------------------------------
 * 環境常數
 *---------------------------------------------------------------
 *
 *  偵錯模式: true || false
 *  運行環境: dev || online
 */
// 偵錯模式
\define('DEBUG', true);
// 運行環境
\define('ENV', 'dev');
// 設定 ROOT PATH
\define('ROOT_PATH', __DIR__);

/*
 *---------------------------------------------------------------
 * 錯誤回報
 *---------------------------------------------------------------
 *
 * 不同環境設定不同級別的錯誤報告
 */
switch ( ENV )
{
    case 'dev':
        \error_reporting(-1);
        \ini_set('display_errors', 1);
        break;

    case 'online':
        \ini_set('display_errors', 0);
        break;

    default:
        \header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
        exit('未設置環境常數');
}
try
{
    /**
     *---------------------------------------------------------------
     * Autoload
     *---------------------------------------------------------------
     */
    include_once "./Kernel/Autoload.php";
    /**
     *---------------------------------------------------------------
     * Request
     *---------------------------------------------------------------
     *
     *  取得 Request
     */
    $request = \Kernel\Request::getUrlPathArray();
    /**
     *---------------------------------------------------------------
     * Route
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





