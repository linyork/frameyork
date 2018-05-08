<?php

use \Core\Route;

try
{
    // home
    Route::add('index', "Home", "index");
    // 個人簡歷
    Route::add('profile/information', "profile", "information");
    Route::add('profile/experience', "profile", "experience");
    Route::add('profile/skill', "profile", "skill");
    // 筆記
    Route::add('note',"note","index");
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

