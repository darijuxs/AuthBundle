<?php

namespace AuthBundle\Helper;

/**
 * Class Generator
 * @package AuthBundle\Helper
 */
class Generator
{
    /**
     * Generate salt that is used to encrypt password
     *
     * @return string
     */
    public static function generateSalt()
    {
        return uniqid(mt_rand(), true);
    }

    /**
     * Generate token.
     *
     * @return string
     */
    public static function generateToken()
    {
        return md5(uniqid("", true));
    }

    /**
     * Generate encrypted password
     *
     * @param $salt
     * @param $secret
     * @param $password
     * @return string
     */
    public static function hash($salt, $secret, $password)
    {
        return hash('sha512', $salt . $secret . $password);
    }
}
