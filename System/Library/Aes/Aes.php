<?php
namespace Library\Aes;

class Aes
{
    public static function encode( string $key, string $iv , $data)
    {
        return rtrim(strtr(base64_encode(openssl_encrypt(serialize($data), 'AES-256-CBC', $key, 1, $iv)), '+/', '-_'), '=');
    }

    public static function decode( string $key, string $iv , string $string)
    {
        return unserialize(openssl_decrypt(base64_decode(str_pad(strtr($string, '-_', '+/'), strlen($string) % 4, '=', 1)), 'AES-256-CBC', $key, 1, $iv));
    }

    public static function generateIV()
    {
        return random_bytes(16);
    }
}
