<?php

namespace Application;

class Home extends \Template\AMaster
{
    public function home()
    {
        $this->addCss("/Assets/css/bootstrap.css");
        $this->addCss("/Assets/css/bootstrap.css");
        $this->setTitle('我愛的人');
        $test = array('test'=>'雞龜骨滾羹');

        $this->display('test.php', $test);
    }
}