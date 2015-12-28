<?php

namespace AuthBundle\Authentication\Model\Token;

use AuthBundle\Authentication\Model\User\UserInterface;

/**
 * Interface TokenInterface
 * @package AuthBundle\Authentication\Model\Token
 */
interface TokenInterface
{
    /**
     * @return UserInterface
     */
    public function getUser();

    /**
     * @return string
     */
    public function getToken();
}
