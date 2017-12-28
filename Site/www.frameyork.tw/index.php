<?php
// 載入核心
require_once "./../../System/Kernel/Kernel.php";

// 設定 Site ROOT PATH
\define('ROOT_PATH', __DIR__);

/*
 *---------------------------------------------------------------
 * 設定 SITE CONFIG PATH
 *---------------------------------------------------------------
 *
 * 依環境選擇 SYSTEM 還是 SITE 的設定檔
 */
if(ENV === 'dev')
{
    \define('CONFIG_PATH', ROOT_PATH . '/Config');
}
if(ENV === 'online')
{
    \define('CONFIG_PATH', SYSTEM_PATH . '/Config');
}

\print_r(\Kernel\Request::getUrlPath());