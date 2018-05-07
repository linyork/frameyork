<?php

namespace Core\Constant;

class NodeType
{
    public const USER          = 'user';

    /**
     * isAllowedNodeType 檢查是否為允許的 nodeType
     *
     * @param string $nodeType
     * @return bool
     *
     * @date   2018/4/22
     * @author York <jason945119@gmail.com>
     */
    public static function isAllowedNodeType( string $nodeType ) : bool
    {
        $class = new \ReflectionClass( __CLASS__ );

        $allowNodeTypes = array_values($class->getConstants());

        return in_array( $nodeType, $allowNodeTypes);
    }
}