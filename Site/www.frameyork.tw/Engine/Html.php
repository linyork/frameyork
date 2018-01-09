<?php

namespace Engine;

abstract class Html extends \Kernel\Html
{
    protected function display(string $viewPath, array $data = array()) : void
    {
        $html = new \Kernel\View(  "master.php");

        $header = new \Kernel\View("header.php");

        $body = new \Kernel\View($viewPath);

        $footer = new \Kernel\View("footer.php");

        $body->set($data);

        $html->set(array(
            'title'         => $this->_title,
            'js'            => $this->_javascript,
            'jsData'        => $this->_jsData,
            'css'           => $this->_css,
            'headerElement' => $header,
            'bodyElement'   => $body,
            'footerElement' => $footer,
        ));
        echo $html;
        exit;
    }
}