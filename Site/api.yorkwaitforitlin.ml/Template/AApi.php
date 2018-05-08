<?php
namespace Template;

abstract class AApi extends \Core\Template\AApi
{
    public $web_id;
    public function __construct()
    {
        parent::__construct();

        // TODO 判斷登入
        if( $this->checkAuth() )
        {
            // 登入
        }
        else
        {
            // 未登入
            $this->responseError(401);
        }
    }

    private function checkAuth() : bool
    {
        return $this->checkOAuth();
    }

    final private function checkOAuth() : bool
    {
        $accessToken = '';
        if( !empty($_REQUEST['accessToken']))
        {
            $accessToken = $_REQUEST['accessToken'];
        }
        if( !empty($_SERVER['HTTP_AUTHORIZATION']))
        {
            $accessToken = $_SERVER['HTTP_AUTHORIZATION'];
        }
        $accessToken = \trim($accessToken);

//        // 測試用
//        $token =  \Library\OAuth\AccessToken::generate('hypenoce');
//        $accessToken =  $token->getAccessToken();
//        // 測試用

        if( !empty($accessToken))
        {
            $ato = \Library\OAuth\AccessToken::parse($accessToken);
            if( $ato->isVerified())
            {
                $data = $ato->getData();
                if( !empty($data['webId']))
                {
                    // TODO 建立身份
                    $this->web_id = $data['webId'];
                    return true;
                }
            }
        }
        return false;
    }
}