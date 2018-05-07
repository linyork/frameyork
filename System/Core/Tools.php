<?php
/**
 * Created by PhpStorm.
 * User: heat
 * Date: 2018/3/11
 * Time: 下午3:16
 */

namespace Core;


class Tools
{
    public static function prt($message)
    {
        echo '<pre>';
        var_dump($message);
        echo '</pre>';
        exit;
    }

    public static function pre($message)
    {
        echo '<pre>';
        var_dump($message);
        echo '<pre>';
    }
}