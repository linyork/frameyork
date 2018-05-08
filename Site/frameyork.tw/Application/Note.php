<?php

namespace Application;

class Note extends \Template\AMaster
{
    public function index()
    {
        $this->addScript('/assets/js/showdown.min.js');
        $this->display('/note.phtml');
    }
}