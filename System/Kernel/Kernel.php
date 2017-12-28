<?php
/*
 *---------------------------------------------------------------
 * 環境常數
 *---------------------------------------------------------------
 *
 *  偵錯模式: true || false
 *  運行環境: dev || online
 *  SYSTEM_PATH常數
 */
// 偵錯模式
\define('DEBUG', true);
// 運行環境
\define('ENV', 'dev');
// SYSTEM_PATH常數
\define('SYSTEM_PATH', __DIR__ . '/../../System');

/*
 *---------------------------------------------------------------
 * 錯誤回報
 *---------------------------------------------------------------
 *
 * 不同環境設定不同級別的錯誤報告
 */
switch(ENV)
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
 * System Autoload
 *---------------------------------------------------------------
 *
 * autoload system || site  之下的各個 class
 */
\spl_autoload_register(function($className) {

    // 自定義允許之 NameSpace
    static $allowNameSpace = array('Kernel', 'Model');

    // 取得 NameSpace
    $nameSpace = \strstr($className, '\\', true);

    // 指定所要讀取的 path
    if( !$nameSpace || !\in_array($nameSpace, $allowNameSpace))
    {
        $path = ROOT_PATH;
    }
    else
    {
        $path = SYSTEM_PATH;
    }

    // 指定 fileName 的路徑
    $fileName = $path . '/' . \str_replace('\\', '/', $className) . '.php';

    if(\is_file($fileName))
    {
        require_once $fileName;
    }
});