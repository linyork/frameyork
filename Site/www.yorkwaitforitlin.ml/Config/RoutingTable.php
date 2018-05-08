<?php

use \Core\Route;

try
{
    // home
    Route::add('index', "Home", "index");
    // 個人簡歷
    Route::add('profile/information', "Profile", "information");
    Route::add('profile/experience', "Profile", "experience");
    Route::add('profile/skill', "Profile", "skill");
    // 筆記
    Route::add('notelist',"Note","noteList");
    Route::add('note',"Note","note");
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

