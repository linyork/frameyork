<?php

namespace Application;

class Home extends \Template\AMaster
{
    public function index()
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
        $this->addCss('/assets/css/components.min.css');
        $this->setTitle('首頁');
        $this->display('/home.phtml',array( "md_list" => $array ));
    }
}