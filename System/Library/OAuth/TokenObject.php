<?php
namespace Library\OAuth;

class TokenObject
{
    private $status      = false;
    private $data        = array();
    private $key         = \Library\Aes\Key::ACCESS_TOKEN_KEY;
    private $vi          = \Library\Aes\Iv::ACCESS_TOKEN_IV;
    private $accessToken = '';

    public function __construct($data)
    {
        if ( is_array($data) )
        {
            $this->data        = $data;
            $this->status      = true;
            $this->accessToken = $this->encode($data);
        }
        if ( is_string($data) )
        {
            $this->accessToken = $data;
            $this->data        = $this->decode($data);
            $this->verified($this->data);
        }
        return $this;
    }

    protected function encode(array $data) : string
    {
        return \Library\Aes\Aes::encode($this->key, $this->vi, $data);
    }

    protected function decode(string $string) : array
    {
        try
        {
            $decodeArray = \Library\Aes\Aes::decode($this->key, $this->vi, $string);
            if (! is_array($decodeArray) )
            {
                throw new \Exception("accessToken is Unable to decrypt");
            }
        }
        catch(\exception $e)
        {
            if ( DEBUG )
            {
                exit($e->getMessage());
            }
            return array();
        }
        return $decodeArray;
    }

    protected function verified(array $data)
    {
        $this->status = true;

        if ( empty($data['system']) or $data['system'] != 'hypenode' )
        {
            $this->status = false;
        }

        if ( empty($data['type']) or $data['type'] != \Library\Aes\Type::ACCESS_TOKEN )
        {
            $this->status = false;
        }

        if ( empty($data['expired']) or $data['expired'] < time() )
        {
            $this->status = false;
        }
    }

    /**
     * isVerified
     *
     * @return bool
     *
     * @date   2018/3/12
     * @author York <jason945119@gmail.com>
     */
    public function isVerified()
    {
        return $this->status;
    }

    /**
     * getData
     *
     * @return array
     *
     * @date   2018/3/12
     * @author York <jason945119@gmail.com>
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * getAccessToken
     *
     * @return string
     *
     * @date   2018/3/12
     * @author York <jason945119@gmail.com>
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }
}