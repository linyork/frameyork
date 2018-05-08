<?php

namespace Application;

class Note extends \Template\AMaster
{
    public function noteList()
    {
        $this->setTitle('筆記表');
        $this->addcss( '/assets/css/components.min.css' );
        $this->addScript( '/assets/js/showdown.min.js' );
        $this->display( '/note-list.phtml' );
    }

    public function note( $filename )
    {
        $this->setTitle(\urldecode( $filename ));
        $this->addScript( '/assets/js/showdown.min.js' );
        $this->display( '/note.phtml', array( "filename" => \urldecode( $filename ) ) );
    }
}