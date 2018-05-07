<?php
namespace Library\Auth;

class Member
{
    private $id = '';
    private $session;
    private static $inited = false;
    private static $cookieName = 'LSKC'; // Login Status Keep Code
    private static $cookieLifeTime = 62072000; // 預設 cookie 生存週期 = 2 years
    private static $sessionNamespace = 'AuthMember';
    /*----------------------------------------------------------------------------------------------------------------*/
    private function __construct( string $sessionId = '' )
    {
        // 啟動鎖定 , 當物件初使化開始後 , cookie name 、 cookie life time 、session namespace 不再接受異動
        static::$inited = true;

        // 初始化 session
        \Core\Session::start( $sessionId );
        if( !isset( $_SESSION[static::$sessionNamespace] ) )
        {
            $_SESSION[static::$sessionNamespace] = '';
        }
        $this->session = &$_SESSION[static::$sessionNamespace];

        // 嘗試取得 session 登入狀態
        $this->initBySession();

        // 如果無法取得 session 登入狀態
        if( !$this->isLogin() )
        {
            // 嘗試使用 cookie 啟動
            $this->initByCookie();
        }
    }

    private function initBySession() : void
    {
        if( !empty( $this->session ) )
        {
            $idInfo = \Core\Sequence::parse( $this->session );
            if( $idInfo['category'] == \Core\Sequence::CATEGORY_MEMBER )
            {
                $this->id = $this->session;
            }
        }
    }

    private function initByCookie() : void
    {
        if( empty( $_COOKIE[static::$cookieName] ) )
        {
            return;
        }
        $data = \Library\Aes\Aes::decode( \Library\Aes\Key::SESSION_ID_KEY, \Library\Aes\Iv::SESSION_ID_IV, $_COOKIE[static::$cookieName] );
        if( empty( $data['system'] ) or empty( $data['type'] ) or empty( $data['memberId'] ) )
        {
            //缺少必要的資訊
            return;
        }
        if( $data['system'] != 'shareba.auth.member' or $data['type'] != 'COOKIE' )
        {
            return;
        }
        $idInfo = \Core\Sequence::parse( $data['memberId'] );
        if( $idInfo['category'] != \Core\Sequence::CATEGORY_MEMBER )
        {
            return;
        }
        // 如果資訊有效 , 延長 cookie 生存週期
        $this->setLoginMemberId( $data['memberId'] );
    }

    private function setLoginMemberId( string $memberId ) : void
    {
        $t = time();
        //寫入 session
        $this->session = $this->id = $memberId;

        //寫入 cookie
        $data = array( 'system'   => 'shareba.auth.member', 'type' => 'COOKIE', 'createTime' => $t,
                       'memberId' => $memberId
        );
        $cookieString = \Library\Aes::encode( \Config\Aes\Key::AUTH_MEMBER_LSKC, \Config\Aes\Iv::AUTH_MEMBER_LSKC, $data );
        setcookie( static::$cookieName, $cookieString, $t + static::$cookieLifeTime, '/', null, null, true );
    }
    /*----------------------------------------------------------------------------------------------------------------*/
    /**
     * isLogin
     *
     * @return bool
     *
     * @date 2018/4/2
     * @author York <jason945119@gmail.com>
     */
    public function isLogin() : bool
    {
        return ( !empty( $this->id ) );
    }

    /**
     * getId
     *
     * @return string
     *
     * @date 2018/4/2
     * @author York <jason945119@gmail.com>
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * put your comment there...
     * @return \Model\Member\Data\Profiles
     */
    public function getProfiles()
    {
        if( $this->isLogin() )
        {
            return \Model\Member\Data\Profiles::instance( $this->id );
        }
        return null;
    }

    public function login( string $account, string $password ) : bool
    {
        $memberId = \Model\Member\Func\Auth::loginByAccount( $account, $password );
        if( empty( $memberId ) )
        {
            return false;
        }
        $this->setLoginMemberId( $memberId );
        return true;
    }

    public function loginThirdAccessToken( string $accessToken, int $thirdCode ) : bool
    {
        $memberId = \Model\Member\Func\Auth::loginByThirdAccessToken( $accessToken, $thirdCode );
        if( empty( $memberId ) )
        {
            return false;
        }
        $this->setLoginMemberId( $memberId );
        return true;
    }

    public function logout() : void
    {
        $this->session = null;
        $this->id = '';
        setcookie( static::$cookieName, '', 0, '/', null, null, true );
    }

    public static function setCookieName( string $name ) : bool
    {
        if( ( static::$inited === false ) and !empty( $name ) )
        {
            static::$cookieName = $name;
            return true;
        }
        return false;
    }

    public static function setCookieLifeTime( int $time ) : bool
    {
        if( ( static::$inited === false ) and ( $time > 0 ) )
        {
            static::$cookieLifeTime = $time;
            return true;
        }
        return false;
    }

    public static function setSessionNamespace( string $namespace ) : bool
    {
        if( ( static::$inited === false ) and !empty( $namespace ) )
        {
            static::$sessionNamespace = $namespace;
            return true;
        }
        return false;
    }
    /*----------------------------------------------------------------------------------------------------------------*/
    /**
     * instance
     *
     * @param string $sessionId
     *
     * @return Member
     *
     * @date 2018/4/2
     * @author York <jason945119@gmail.com>
     */
    public static function instance( string $sessionId = '' ) : self
    {
        static $object;
        if( !isset( $object ) )
        {
            $object = new self( $sessionId );
        }
        return $object;
    }
}