<?php

namespace AuthBundle\Authentication\CurrentUser;

use AuthBundle\Authentication\Interfaces\CurrentUserInterface;

/**
 * Class CurrentUserDocument
 * @package AuthBundle\Authentication\CurrentUser
 */
class CurrentUserDocument implements CurrentUserInterface
{
    /**
     * @param $username
     * @return $this
     */
    public function getUserByUsername($username)
    {
        return $this;
    }

    /**
     * @param $token
     * @return $this
     */
    public function getUserByToken($token)
    {
        return $this;
    }
}
