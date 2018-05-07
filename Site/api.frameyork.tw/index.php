<?php
/**
 *---------------------------------------------------------------
 * 基本設定及常數設定
 *---------------------------------------------------------------
 * 無特殊需求切勿更動
 */
// 時區設定
date_default_timezone_set('UTC');
// CONST::Fully Qualified Domain Name
define('MAIN_DOMAIN', basename(__DIR__));
// CONST::HTTP Protocol
define('HTTP', 'http');
define('HTTPS', 'https');
// CONST::Environment Name
define('DEV', 'dev');
define('BETA', 'beta');
define('PREV', 'prev');
define('PROD', 'prod');

/**
 *---------------------------------------------------------------
 * 系統常數設定
 *---------------------------------------------------------------
 * 依照 domain 來指定 root view config env 的路徑
 * 無特殊需求切勿更動
 */
// 系統根目錄
define('SYSTEM_PATH', __DIR__ . '/../../System');
// 應用程式根目錄
define('ROOT_PATH', __DIR__);
// 視圖路徑
define('VIEW_PATH', ROOT_PATH . '/View');
// 設定檔路徑
define('CONFIG_PATH', ROOT_PATH . '/Config');
// 環境設定檔路徑
define('ENV_FILE_PATH', CONFIG_PATH . '/Env');


/**
 *---------------------------------------------------------------
 * 載入autoload 及 routing table
 *---------------------------------------------------------------
 * 無特殊需求切勿更動
 */
// System Autoload
require_once SYSTEM_PATH . '/autoload.php';
// 路由設定檔
require_once CONFIG_PATH . '/RoutingTable.php';


/**
 *---------------------------------------------------------------
 * 解析 request
 *---------------------------------------------------------------
 * TODO:  持續優化
 */
try
{
    // 檢查當前環境
    define('ENV', \Core\Config::getEnvName());

    // 讀取環境設定
    \Core\Config::loadEnvFile();

    // URL前綴處理
    $urlPrefix = ENV.'-';
    if(ENV === PROD)
    {
        $urlPrefix = '';
    }

    define('URL_PREFIX', $urlPrefix);
    define('FULL_DOMAIN', URL_PREFIX . MAIN_DOMAIN);
    define('FULL_URL', \Core\Config::getRequestScheme() . FULL_DOMAIN);

    // Route 解析
    \Core\Route::dispath();
}
catch(\Exception $e)
{
    if ( defined('DEBUG') )
    {
        if ( DEBUG )
        {
            echo $e->getMessage();
            exit;
        }
    }
    header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
}