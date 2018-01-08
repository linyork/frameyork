<?php

namespace Kernel;

abstract class Html
{
    protected $_javascript = array();
    protected $_css        = array();
    protected $_title      = '';
    protected $_jsData     = array();

    public function __construct()
    {
        \header('Content-Type:text/html; charset=utf-8');
    }

    public function setTitle(string $title) : Html
    {
        $this->_title = $title;
        return $this;
    }

    public function addScript(string $filePath) : Html
    {
        $this->_javascript[] = $filePath;
        return $this;
    }

    public function addCss(string $filePath) : Html
    {
        $this->_css[] = $filePath;
        return $this;
    }

    public function addJsData(string $name, $value) : Html
    {
        $this->_jsData[$name] = $value;

        return $this;
    }

    protected function display(string $viewPath, array $data = array()) : void
    {
        $view = new \Kernel\View($viewPath);

        $view->set($data);

        $html = new \Kernel\View( SYSTEM_PATH."/View/html.php");

        $html->set(array(
            'title'   => $this->_title,
            'js'      => $this->_javascript,
            'jsData'  => $this->_jsData,
            'css'     => $this->_css,
            'mainDiv' => $view,
        ));
        echo $html;
        exit;
    }
}