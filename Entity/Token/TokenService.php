<?php

namespace AuthBundle\Entity\Token;

use DateTime;
use DateInterval;
use AuthBundle\Authentication\DoctrineManager;
use AuthBundle\Entity\User\User;

/**
 * Class TokenService
 * @package AuthBundle\Entity\Token
 */
class TokenService extends DoctrineManager
{
    /**
     * @var TokenRepository
     */
    private $tokenRepo;

    public function init()
    {
        $this->tokenRepo = $this->getManager()->getRepository(Token::class);
    }

    /**
     * @param User $user
     */
    public function create(User $user)
    {
        $token = md5(uniqid("", true));

        $expiresAt = (new DateTime())
            ->add(new DateInterval("P7D"));

        $token = (new Token())
            ->setUser($user)
            ->setToken($token)
            ->setExpiresAt($expiresAt);

        $this->getManager()->persist($token);
        $this->getManager()->flush();


    }
}
