<?php

namespace Config;

class RoutingTable
{
    public static function getRoutingTable() : array
    {
        return array(
            "test/echotest" => array("\Application\Test", "echoTest")
        );
    }
}
