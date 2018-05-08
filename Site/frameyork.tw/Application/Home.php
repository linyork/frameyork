<?php

namespace Application;

class Home extends \Template\AMaster
{
    public function index()
    {
        $this->addCss('/assets/css/components.min.css');
        $this->setTitle('首頁');
        $this->display('/home.phtml');
    }
}