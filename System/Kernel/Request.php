<?php

namespace Kernel;

class Request
{
    public static function getUrlPath()
    {
        return \explode('/', \substr(\parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), 1));
    }

}