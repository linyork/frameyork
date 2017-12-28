<?php
namespace Model\Base;

/**
 * Class Singleton
 * @package Model\Base
 */
abstract class Singleton
{
    final protected function __construct()
    {

    }

    abstract protected function init( $initData );

    /**
     * put your comment there...
     *
     * @param mixed $initData
     *
     * @return static::class
     */
    public static function getInstance( $initData = null )
    {
        static $object = array();

        $class = '\\' . static::class;
        if( !isset($object[$class]) )
        {
            $object[$class] = new $class();
        }
        if( isset($initData) )
        {
            $object[$class]->init($initData);
        }
        return $object[$class];
    }

}