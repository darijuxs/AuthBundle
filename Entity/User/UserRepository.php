<?php

namespace AuthBundle\Entity\User;

use DateTime;
use Doctrine\ORM\EntityRepository;
use AuthBundle\Authentication\Model\User\UserRepositoryInterface;

/**
 * Class UserRepository
 * @package AuthBundle\Entity\User
 */
class UserRepository extends EntityRepository implements UserRepositoryInterface
{
    /**
     * @return \Doctrine\ORM\QueryBuilder
     */
    private function baseQuery()
    {
        return $this->createQueryBuilder("u")
            ->andWhere("u.active = :active")
            ->andWhere("u.deleted = :deleted")
            ->setParameter("active", true)
            ->setParameter("deleted", false);
    }

    /**
     * @param string $username
     * @return null|User
     */
    public function findOneByUsername($username)
    {
        return $this->baseQuery()
            ->andWhere("u.username = :username")
            ->setParameter("username", $username)
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * @param string $token
     * @return null|User
     */
    public function findOneByToken($token)
    {
        return $this->baseQuery()
            ->join("u.tokens", "t")
            ->andWhere("t.token = :token")
            ->andWhere("t.expiresAt > :expiresAt")
            ->setParameter("token", $token)
            ->setParameter("expiresAt", new DateTime())
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
