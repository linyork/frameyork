<?php

namespace Application;

class Home extends \Template\AMaster
{
    public function index()
    {
        $this->setTitle('首頁');
        $this->display('/home.phtml');
    }
}