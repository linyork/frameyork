<?php

namespace Config;

class RoutingTable
{
    public static function getRoutingTable() : array
    {
        return array(
            "home" => array("\Application\Home", "home")
        );
    }
}
