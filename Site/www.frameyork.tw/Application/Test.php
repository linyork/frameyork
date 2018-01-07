<?php

namespace Application;

class Test
{
    public function echoTest($test)
    {
        echo $test;
        echo '雞龜骨滾羹' . $_GET['test'];
    }
}