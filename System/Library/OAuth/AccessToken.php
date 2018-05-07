<?php
namespace Library\OAuth;

class AccessToken
{
    // 過期秒數(一天)
    const EXPIRE = 2073600;

    public static function generate( string $member = '0' ) : \Library\OAuth\TokenObject
    {
        $thisMoment = time();
        return new \Library\OAuth\TokenObject(
            array( 'system'     => 'hypenode',
                   'createTime' => $thisMoment,
                   'expired'    => $thisMoment + self::EXPIRE,
                   'type'       => \Library\Aes\Type::ACCESS_TOKEN,
                   'member'     => $member
        ) );
    }

    public static function parse( string $accessToken ) : \Library\OAuth\TokenObject
    {
        return new \Library\OAuth\TokenObject( $accessToken );
    }
}
