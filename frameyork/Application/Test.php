<?php

namespace Application;

class Test extends \Template\IMaster
{
    public function echoTest()
    {
        $this->setTitle('我愛的人');
        $test = array('test'=>'雞龜骨滾羹');

        $this->display('test.php', $test);

    }
}