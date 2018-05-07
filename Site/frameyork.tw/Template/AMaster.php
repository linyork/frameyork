<?php

namespace Template;

abstract class AMaster extends \Core\Template\AHtml
{
    protected function display( string $viewPath, array $data = array() ) : void
    {
        // 最外框
        $html = new \Core\View('/master.phtml');

        // header
        $header = new \Core\View('/header.phtml');
        $header->setViewData( array( 'title' => $this->_title ) );

        // body
        $body   = new \Core\View($viewPath);
        $body->setViewData($data);

        // footer
        $footer = new \Core\View('/footer.phtml');

        // 組版
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