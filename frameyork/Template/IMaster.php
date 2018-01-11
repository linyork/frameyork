<?php

namespace Template;

abstract class IMaster extends \Kernel\IHtml
{
    protected function display(string $viewPath, array $data = array()) : void
    {
        $html   = new \Kernel\View(  "master.php");

        $header = new \Kernel\View("header.php");

        $body   = new \Kernel\View($viewPath);

        $body->setViewData($data);

        $footer = new \Kernel\View("footer.php");


        $html->setViewData(array(
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