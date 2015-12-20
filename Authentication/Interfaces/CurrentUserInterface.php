<?php

namespace AuthBundle\Authentication\Interfaces;

use AuthBundle\Entity\User\User as UserEntity;
use AuthBundle\Document\User\User as UserDocument;

/**
 * Interface CurrentUserInterface
 * @package AuthBundle\Authentication\Interfaces
 */
interface CurrentUserInterface
{
    /**
     * @param $username - string
     * @return UserEntity|UserDocument|null
     */
    public function getUserByUsername($username);

    /**
     * @param $token - string
     * @return UserEntity|UserDocument|null
     */
    public function getUserByToken($token);
}
