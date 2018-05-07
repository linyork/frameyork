<?php

namespace Core;

class Session
{
    public static function start( $sessionId = '' ) : void
    {
        $osid = session_id();

        if( empty( $osid ) )
        {
            if( ! empty( $sessionId ) )
            {
                session_id( $sessionId );
            }

            $domain = FULL_DOMAIN;
            $https  = \Core\Request::isHttps();

            session_set_cookie_params( 0, '/', $domain, $https, true );
            session_start();
        }
    }
}