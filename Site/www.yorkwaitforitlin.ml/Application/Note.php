<?php

namespace Application;

class Note extends \Template\AMaster
{
    public function noteList()
    {
        $array = array();
        $dirname = ROOT_PATH . "/assets/md/";
        $dh = \opendir( $dirname );
        while( $dave = \readdir( $dh ) )
        {
            if( $dave != "." && $dave != ".." )
            {
                $file = \explode("-", $dave);
                if( isset( $array[$file[0]]) )
                {
                    \array_push($array[$file[0]], $file[1] );
                }
                else
                {
                    $array[$file[0]] = array();
                    \array_push($array[$file[0]], $file[1] );
                }
            }
        }
        \closedir( $dh );
        $this->setTitle('筆記表');
        $this->addcss( '/assets/css/components.min.css' );
        $this->addScript( '/assets/js/showdown.min.js' );
        $this->display( '/note-list.phtml', array( "list" => $array ) );
    }

    public function note( $filename )
    {
        $this->setTitle( \urldecode( $filename ) );
        $this->addScript( '/assets/js/showdown.min.js' );
        $this->display( '/note.phtml', array( "filename" => \urldecode( $filename ) ) );
    }
}