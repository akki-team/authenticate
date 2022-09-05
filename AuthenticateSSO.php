<?php

use phpseclib3\Crypt\Random;

/**
 * AuthenticateSSO
 *
 * Encrypt/Decrypt login
 */
class AuthenticateSSO
{
    private $key;

    public function __construct($key)
    {
        $this->key = $key;
    }

    protected function getCipher($iv, $key){
        $cipher = new \phpseclib3\Crypt\AES('ctr');
        $cipher->setKey($this->key);
        $cipher->setIV($iv);
        $cipher->setKey($key);
        return $cipher;
    }

    /***
     * Encrypt Login
     * @param $login
     * @return string
     */
    public function encrypt($login)
    {
        $iv = Random::string(16);
        $key = Random::string(16);
        $cipher = $this->getCipher($iv, $key);

        return base64_encode(json_encode([
            'iv' => base64_encode($iv),
            'key' => base64_encode($key),
            'data' => base64_encode($cipher->encrypt($login))
        ]));
    }

    /***
     * Decrypt Login
     * @param $data
     * @return string
     */
    public function decrypt($data)
    {
        $data = json_decode(base64_decode($data), true);
        return $this->getCipher(
            base64_decode($data['iv']),
            base64_decode($data['key']))
            ->decrypt(base64_decode($data['data']));
    }


}
