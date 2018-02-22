<?php

namespace Config;

class RoutingTable
{
    public static function getRoutingTable() : array
    {
        /**
         *---------------------------------------------------------------
         * Routing Table
         *---------------------------------------------------------------
         *  key   值為 request 字串的前兩個
         *  value 值為 Application 的class Name 及 function Name
         */
        return array(
            "home" => array("\Application\Home", "home"),
            "home/2" => array("\Application\Home", "home")
        );
    }
}
