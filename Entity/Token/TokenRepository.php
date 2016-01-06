<?php

namespace AuthBundle\Entity\Token;

use DateTime;
use AuthBundle\Entity\User\User;
use Doctrine\ORM\EntityRepository;

/**
 * Class TokenRepository
 * @package AuthBundle\Entity\Token
 */
class TokenRepository extends EntityRepository
{
    /**
     * @param User $user
     * @return Token[]
     */
    public function findExpiresTokenByUser(User $user)
    {
        return $this->createQueryBuilder("t")
            ->andWhere("t.expiresAt < :expiresAt")
            ->andWhere('t.user = :user')
            ->setParameter("expiresAt", new DateTime())
            ->setParameter("user", $user)
            ->getQuery()
            ->getResult();
    }

    /**
     * @param User $user
     * @return Token[]
     */
    public function findAllByUser(User $user)
    {
        return $this->createQueryBuilder("t")
            ->andWhere('t.user = :user')
            ->setParameter("user", $user)
            ->getQuery()
            ->getResult();
    }
}
