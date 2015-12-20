<?php

namespace AuthBundle\Authentication\CurrentUser;

use AuthBundle\Entity\User\User;
use AuthBundle\Authentication\Interfaces\CurrentUserInterface;
use AuthBundle\Authentication\Exception\UserNotFound;
use Doctrine\ORM\EntityManager;

/**
 * Class CurrentUserEntity
 * @package AuthBundle\Authentication\CurrentUser
 */
class CurrentUserEntity implements CurrentUserInterface
{
    /**
     * @var EntityManager
     */
    private $em;

    /**
     * CurrentUserEntity constructor.
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * @param string $username
     * @return User
     * @throws UserNotFound
     */
    public function getUserByUsername($username)
    {
        $user = $this
            ->em
            ->getRepository(User::class)
            ->findOneByUsername($username);

        if ($user instanceof User) {
            return $user;
        }

        throw new UserNotFound($username);
    }

    /**
     * @param string $token
     * @return User|null
     * @throws UserNotFound
     */
    public function getUserByToken($token)
    {
        $user = $this
            ->em
            ->getRepository(User::class)
            ->findOneByToken($token);

        if ($user instanceof User) {
            return $user;
        }

        throw new UserNotFound();
    }
}
