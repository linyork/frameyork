<?php

namespace Kernel;

class Agent extends \Model\Base\Singleton
{
    static public $agent = NULL;

    static public $isBrowser = FALSE;
    static public $isRobot   = FALSE;
    static public $isMobile  = FALSE;

    static public $platform = '';
    static public $browser  = '';
    static public $version  = '';
    static public $mobile   = '';

    static public $platforms = array('windows nt 10.0' => 'Windows 10',
                                     'windows nt 6.3'  => 'Windows 8.1',
                                     'windows nt 6.2'  => 'Windows 8',
                                     'windows nt 6.1'  => 'Windows 7',
                                     'windows nt 6.0'  => 'Windows Vista',
                                     'windows nt 5.2'  => 'Windows 2003',
                                     'windows nt 5.1'  => 'Windows XP',
                                     'windows nt 5.0'  => 'Windows 2000',
                                     'windows nt 4.0'  => 'Windows NT 4.0',
                                     'winnt4.0'        => 'Windows NT 4.0',
                                     'winnt 4.0'       => 'Windows NT',
                                     'winnt'           => 'Windows NT',
                                     'windows 98'      => 'Windows 98',
                                     'win98'           => 'Windows 98',
                                     'windows 95'      => 'Windows 95',
                                     'win95'           => 'Windows 95',
                                     'windows phone'   => 'Windows Phone',
                                     'windows'         => 'Unknown Windows OS',
                                     'android'         => 'Android',
                                     'blackberry'      => 'BlackBerry',
                                     'iphone'          => 'iOS',
                                     'ipad'            => 'iOS',
                                     'ipod'            => 'iOS',
                                     'os x'            => 'Mac OS X',
                                     'ppc mac'         => 'Power PC Mac',
                                     'freebsd'         => 'FreeBSD',
                                     'ppc'             => 'Macintosh',
                                     'linux'           => 'Linux',
                                     'debian'          => 'Debian',
                                     'sunos'           => 'Sun Solaris',
                                     'beos'            => 'BeOS',
                                     'apachebench'     => 'ApacheBench',
                                     'aix'             => 'AIX',
                                     'irix'            => 'Irix',
                                     'osf'             => 'DEC OSF',
                                     'hp-ux'           => 'HP-UX',
                                     'netbsd'          => 'NetBSD',
                                     'bsdi'            => 'BSDi',
                                     'openbsd'         => 'OpenBSD',
                                     'gnu'             => 'GNU/Linux',
                                     'unix'            => 'Unknown Unix OS',
                                     'symbian'         => 'Symbian OS');

    static public $browsers = array('OPR'               => 'Opera',
                                    'Flock'             => 'Flock',
                                    'Edge'              => 'Spartan',
                                    'Chrome'            => 'Chrome',
                                    'Opera.*?Version'   => 'Opera',
                                    'Opera'             => 'Opera',
                                    'MSIE'              => 'Internet Explorer',
                                    'Internet Explorer' => 'Internet Explorer',
                                    'Trident.* rv'      => 'Internet Explorer',
                                    'Shiira'            => 'Shiira',
                                    'Firefox'           => 'Firefox',
                                    'Chimera'           => 'Chimera',
                                    'Phoenix'           => 'Phoenix',
                                    'Firebird'          => 'Firebird',
                                    'Camino'            => 'Camino',
                                    'Netscape'          => 'Netscape',
                                    'OmniWeb'           => 'OmniWeb',
                                    'Safari'            => 'Safari',
                                    'Mozilla'           => 'Mozilla',
                                    'Konqueror'         => 'Konqueror',
                                    'icab'              => 'iCab',
                                    'Lynx'              => 'Lynx',
                                    'Links'             => 'Links',
                                    'hotjava'           => 'HotJava',
                                    'amaya'             => 'Amaya',
                                    'IBrowse'           => 'IBrowse',
                                    'Maxthon'           => 'Maxthon',
                                    'Ubuntu'            => 'Ubuntu Web Browser');

    static public $mobiles = array('mobileexplorer'       => 'Mobile Explorer',
                                   'palmsource'           => 'Palm',
                                   'palmscape'            => 'Palmscape',
                                   'motorola'             => 'Motorola',
                                   'nokia'                => 'Nokia',
                                   'palm'                 => 'Palm',
                                   'iphone'               => 'Apple iPhone',
                                   'ipad'                 => 'iPad',
                                   'ipod'                 => 'Apple iPod Touch',
                                   'sony'                 => 'Sony Ericsson',
                                   'ericsson'             => 'Sony Ericsson',
                                   'blackberry'           => 'BlackBerry',
                                   'cocoon'               => 'O2 Cocoon',
                                   'blazer'               => 'Treo',
                                   'lg'                   => 'LG',
                                   'amoi'                 => 'Amoi',
                                   'xda'                  => 'XDA',
                                   'mda'                  => 'MDA',
                                   'vario'                => 'Vario',
                                   'htc'                  => 'HTC',
                                   'samsung'              => 'Samsung',
                                   'sharp'                => 'Sharp',
                                   'sie-'                 => 'Siemens',
                                   'alcatel'              => 'Alcatel',
                                   'benq'                 => 'BenQ',
                                   'ipaq'                 => 'HP iPaq',
                                   'mot-'                 => 'Motorola',
                                   'playstation portable' => 'PlayStation Portable',
                                   'playstation 3'        => 'PlayStation 3',
                                   'playstation vita'     => 'PlayStation Vita',
                                   'hiptop'               => 'Danger Hiptop',
                                   'nec-'                 => 'NEC',
                                   'panasonic'            => 'Panasonic',
                                   'philips'              => 'Philips',
                                   'sagem'                => 'Sagem',
                                   'sanyo'                => 'Sanyo',
                                   'spv'                  => 'SPV',
                                   'zte'                  => 'ZTE',
                                   'sendo'                => 'Sendo',
                                   'nintendo dsi'         => 'Nintendo DSi',
                                   'nintendo ds'          => 'Nintendo DS',
                                   'nintendo 3ds'         => 'Nintendo 3DS',
                                   'wii'                  => 'Nintendo Wii',
                                   'open web'             => 'Open Web',
                                   'openweb'              => 'OpenWeb',
                                   'android'              => 'Android',
                                   'symbian'              => 'Symbian',
                                   'SymbianOS'            => 'SymbianOS',
                                   'elaine'               => 'Palm',
                                   'series60'             => 'Symbian S60',
                                   'windows ce'           => 'Windows CE',
                                   'obigo'                => 'Obigo',
                                   'netfront'             => 'Netfront Browser',
                                   'openwave'             => 'Openwave Browser',
                                   'mobilexplorer'        => 'Mobile Explorer',
                                   'operamini'            => 'Opera Mini',
                                   'opera mini'           => 'Opera Mini',
                                   'opera mobi'           => 'Opera Mobile',
                                   'fennec'               => 'Firefox Mobile',
                                   'digital paths'        => 'Digital Paths',
                                   'avantgo'              => 'AvantGo',
                                   'xiino'                => 'Xiino',
                                   'novarra'              => 'Novarra Transcoder',
                                   'vodafone'             => 'Vodafone',
                                   'docomo'               => 'NTT DoCoMo',
                                   'o2'                   => 'O2',
                                   'mobile'               => 'Generic Mobile',
                                   'wireless'             => 'Generic Mobile',
                                   'j2me'                 => 'Generic Mobile',
                                   'midp'                 => 'Generic Mobile',
                                   'cldc'                 => 'Generic Mobile',
                                   'up.link'              => 'Generic Mobile',
                                   'up.browser'           => 'Generic Mobile',
                                   'smartphone'           => 'Generic Mobile',
                                   'cellphone'            => 'Generic Mobile');

    // --------------------------------------------------------------------

    public static function instance($httpUserAgent) : self
    {
        return parent::getInstance($httpUserAgent);
    }

    public function init($httpUserAgent)
    {
        if ( isset($httpUserAgent) )
        {
            static::$agent = trim($httpUserAgent);
            static::_compile_data();
        }
        //todo 處理沒有 USER_AGENT 的狀況
    }


    protected function _compile_data()
    {
        static::_set_platform();

        foreach ( array('_set_platform', '_set_browser', '_set_mobile') as $function )
        {
            if ( static::$function() === TRUE )
            {
                break;
            }
        }
    }

    // --------------------------------------------------------------------

    protected function _set_platform()
    {
        if ( \is_array(static::$platforms) && \count(static::$platforms) > 0 )
        {
            foreach ( static::$platforms as $key => $val )
            {
                if ( \preg_match('|' . \preg_quote($key) . '|i', static::$agent) )
                {
                    static::$platform = $val;
                    return TRUE;
                }
            }
        }

        static::$platform = 'Unknown Platform';
        return FALSE;
    }


    protected function _set_browser()
    {
        if ( \is_array(static::$browsers) && \count(static::$browsers) > 0 )
        {
            foreach ( static::$browsers as $key => $val )
            {
                if ( \preg_match('|' . $key . '.*?([0-9\.]+)|i', static::$agent, $match) )
                {
                    static::$isBrowser = TRUE;
                    static::$version   = $match[1];
                    static::$browser   = $val;
                    static::_set_mobile();
                    return TRUE;
                }
            }
        }

        return FALSE;
    }

    protected function _set_mobile()
    {
        if ( \is_array(static::$mobiles) && \count(static::$mobiles) > 0 )
        {
            foreach ( static::$mobiles as $key => $val )
            {
                if ( FALSE !== (\stripos(static::$agent, $key)) )
                {
                    static::$isMobile = TRUE;
                    static::$mobile   = $val;
                    return TRUE;
                }
            }
        }

        return FALSE;
    }

    // --------------------------------------------------------------------

    public function isBrowser($key = NULL)
    {
        if ( ! static::$isBrowser )
        {
            return FALSE;
        }
        if ( $key === NULL )
        {
            return TRUE;
        }

        // Check for a specific browser
        return (isset(static::$browsers[$key]) && static::$browser === static::$browsers[$key]);
    }

    public function isMobile($key = NULL)
    {
        if ( ! static::$isMobile )
        {
            return FALSE;
        }
        if ( $key === NULL )
        {
            return TRUE;
        }

        // Check for a specific robot
        return (isset(static::$mobiles[$key]) && static::$mobile === static::$mobiles[$key]);
    }

    public function agent_string()
    {
        return static::$agent;
    }

    public function platform()
    {
        return static::$platform;
    }

    public function browser()
    {
        return static::$browser;
    }

    public function version()
    {
        return static::$version;
    }

    public function mobile()
    {
        return static::$mobile;
    }
}
