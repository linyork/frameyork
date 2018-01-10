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
\define('ROOT_PATH', __DIR__."/..");

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
        echo '未設置環境常數';
        exit(1);
}

/*
 *---------------------------------------------------------------
 * Autoload
 *---------------------------------------------------------------
 */
\spl_autoload_register(function($className)
{
    try
    {
        $fileName = ROOT_PATH . '/' . \str_replace('\\', '/', $className) . '.php';

        if ( ! \is_file($fileName) )
        {
            throw new \Exception("$fileName  Class Not Exists ");
        }
        require_once $fileName;
    }
    catch ( \Exception $e )
    {
        header('HTTP/1.1 500 Internal Server Error');
        if(DEBUG)
        {
            exit($e->getMessage());
        }
    }
});