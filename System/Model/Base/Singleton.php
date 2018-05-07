<?php
namespace Model\Base;

/**
 * Class Singleton
 * @package Model\Base
 */
abstract class Singleton
{
    final protected function __construct(){}

    abstract protected function init( $initData );

    public static function getInstance( $initData )
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