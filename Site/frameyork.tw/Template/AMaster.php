<?php

namespace Template;

abstract class AMaster extends \Core\Template\AHtml
{
    public function __construct()
    {
        parent::__construct();

        // TODO 判斷登入
        if(true)
        {
            // 登入
        }
        else
        {
            // 未登入
            $html = new \Core\View('/login.php');
            echo $html;
            exit;
        }
    }

    protected function display(string $viewPath, array $data = array()) : void
    {
        // 最外框
        $html = new \Core\View('/master.php');

        // header
        $header = new \Core\View('/header.php');

        // body
        $body   = new \Core\View($viewPath);
        $body->setViewData($data);

        // footer
        $footer = new \Core\View('/footer.php');

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