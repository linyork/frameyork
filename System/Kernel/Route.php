<?php
namespace Kernel;

class Route extends \Model\Base\Singleton
{
    // --------------------------------------------------------------------

    public static function instance($httpUserAgent): self
    {
        return parent::getInstance($httpUserAgent);
    }

    public function init($httpUserAgent)
    {
        if(isset($httpUserAgent))
        {
            static::$agent = trim($httpUserAgent);
            static::_compile_data();
        }
        //todo 處理沒有 USER_AGENT 的狀況
    }


    protected function _compile_data()
    {
        static::_set_platform();

        foreach(array('_set_platform', '_set_browser', '_set_mobile') as $function)
        {
            if(static::$function() === TRUE)
            {
                break;
            }
        }
    }

    // --------------------------------------------------------------------
}