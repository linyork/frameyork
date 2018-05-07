<?php

use \Core\Route;

try
{
    Route::add('index', "Home", "index");
    Route::add('profile/information', "profile", "information");
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

