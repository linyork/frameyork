<?php

namespace Core\Template;

abstract class AHtml
{
    protected $_title       = '';
    protected $_javascript  = array();
    protected $_css         = array();
    protected $_jsData      = array();

    /*----------------------------------------------------------------------------------------------------------------*/
    public function __construct()
    {
        \header( 'Content-Type:text/html; charset=utf-8' );
    }

    /*----------------------------------------------------------------------------------------------------------------*/
    public function setTitle( string $title ) : AHtml
    {
        $this->_title = $title;
        return $this;
    }

    public function addScript( string $filePath ) : AHtml
    {
        $this->_javascript[] = $filePath;
        return $this;
    }

    public function addCss( string $filePath ) : AHtml
    {
        $this->_css[] = $filePath;
        return $this;
    }

    public function addJsData( string $name, $value ) : AHtml
    {
        $this->_jsData[$name] = $value;

        return $this;
    }

    abstract protected function display( string $viewPath, array $data = array() );
}