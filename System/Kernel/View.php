<?php

namespace Kernel;

class View
{
    protected $_viewPath = '';
    protected $_data     = array();
    protected $_content  = '';

    public function __construct(string $viewPath)
    {
        $this->_viewPath = ROOT_PATH . '/View/' . $viewPath;

        if ( ! \is_file($this->_viewPath) )
        {
            throw new \RuntimeException('View File Not Exists ("' . $this->_viewPath . '")');
        }
    }

    public function __toString() : string
    {
        $this->execute();
        if ( defined('COMPRESSION_VIEW') && COMPRESSION_VIEW )
        {
            return str_replace(array("\t", '  ',), '', $this->___content);
        }
        return $this->_content;
    }

    public function _set($key, $value) : void
    {
        $this->_data[$key] = $value;
    }

    public function set($key, $value = null) : View
    {
        if ( \is_array($key) )
        {
            foreach ( $key as $k => $v )
            {
                $this->_set($k, $v);
            }
        }
        else
        {
            $this->_set($key, $value);
        }

        return $this;
    }

    public function execute() : void
    {
        \extract($this->_data);
        include $this->_viewPath;
    }
}