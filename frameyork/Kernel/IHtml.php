<?php

namespace Kernel;

abstract class IHtml
{
    protected $_javascript = array();
    protected $_css        = array();
    protected $_title      = '';
    protected $_jsData     = array();

    public function __construct()
    {
        \header('Content-Type:text/html; charset=utf-8');
    }

    public function setTitle(string $title) : IHtml
    {
        $this->_title = $title;
        return $this;
    }

    public function addScript(string $filePath) : IHtml
    {
        $this->_javascript[] = $filePath;
        return $this;
    }

    public function addCss(string $filePath) : IHtml
    {
        $this->_css[] = $filePath;
        return $this;
    }

    public function addJsData(string $name, $value) : IHtml
    {
        $this->_jsData[$name] = $value;

        return $this;
    }

    abstract protected function display(string $viewPath, array $data = array());
}