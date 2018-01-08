<?php

namespace Kernel;

class View
{
    protected $_viewPath  = '';
    protected $_data = array();
    protected $_content  = '';

    /**
     * View constructor.
     * @param array $viewPath
     */
    public function __construct(array $viewPath) {
        $this->_viewPath = ROOT_PATH . '/Template/' . $viewPath;
        if ( ! is_file( $this->_viewPath ) )
        {
            throw new \RuntimeException( 'Error! View File Not Exists ("' . $this->_viewPath . '")' );
        }
    }
};