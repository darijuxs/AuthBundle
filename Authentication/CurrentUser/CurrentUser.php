<?php

namespace AuthBundle\Authentication\CurrentUser;

use AuthBundle\Authentication\DoctrineManager;
use AuthBundle\Authentication\Exception\InterfaceNotImplemented;
use AuthBundle\Authentication\Interfaces\CurrentUserInterface;
use AuthBundle\Entity\User\User as UserEntity;
use AuthBundle\Document\User\User as UserDocument;

/**
 * Class CurrentUser
 * @package AuthBundle\Authentication\CurrentUser
 */
class CurrentUser extends DoctrineManager
{
    /**
     * @var CurrentUserInterface
     */
    private $currentUserClass;

    /**
     * @param $currentUser
     * @throws InterfaceNotImplemented
     */
    public function setCurrentUserManager($currentUser)
    {
        $this->currentUserClass = new $currentUser($this->getManager());

        if (!$this->currentUserClass instanceof CurrentUserInterface) {
            throw new InterfaceNotImplemented(CurrentUserInterface::class, get_class($this->currentUserClass));
        }
    }

    /**
     * @param $username
     * @return UserEntity|UserDocument|null
     */
    public function getUserByUsername($username)
    {
        return $this->currentUserClass->getUserByUsername($username);
    }

    /**
     * @param string $token
     * @return UserEntity|UserDocument|null
     */
    public function getUserByToken($token)
    {
        return $this->currentUserClass->getUserByToken($token);
    }
}
