<?php

namespace Core;

class View
{
    protected $_viewPath = '';
    protected $_data     = array();
    protected $_content  = '';
    /*----------------------------------------------------------------------------------------------------------------*/
    public function __construct(string $viewPath)
    {
        $this->_viewPath = ROOT_PATH . '/View' . $viewPath;

        if ( ! \is_file($this->_viewPath) )
        {
            throw new \RuntimeException('View File Not Exists ("' . $this->_viewPath . '")');
        }
    }

    public function __toString() : string
    {
        \extract( $this->_data );

        \ob_start();
        include $this->_viewPath;
        $this->_content = \ob_get_contents();
        \ob_end_clean();

        return $this->_content;
    }
    /*----------------------------------------------------------------------------------------------------------------*/
    public function setViewData($key, $value = null) : View
    {
        if ( \is_array($key) )
        {
            foreach ( $key as $k => $v )
            {
                $this->_data[$k] = $v;
            }
        }
        else
        {
            $this->_data[$key] = $value;
        }

        return $this;
    }
}