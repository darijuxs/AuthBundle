<?php

namespace AuthBundle\Authentication\Model\User;

/**
 * Interface UserRepositoryInterface
 * @package AuthBundle\Authentication\Model\User
 */
interface UserRepositoryInterface
{
    /**
     * @param $username - string
     * @return UserInterface|null
     */
    public function findOneByUsername($username);

    /**
     * @param $token - string
     * @return UserInterface|null
     */
    public function findOneByToken($token);
}
