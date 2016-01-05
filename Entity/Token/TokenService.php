<?php

namespace AuthBundle\Entity\Token;

use DateTime;
use DateInterval;
use AuthBundle\Helper\Generator;
use AuthBundle\Entity\User\User;
use AuthBundle\Authentication\DoctrineManager;

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
        $this->tokenRepo = $this
            ->getManager()
            ->getRepository(Token::class);
    }

    /**
     * @param User $user
     * @return $this
     */
    public function create(User $user)
    {
        $expiresAt = (new DateTime())
            ->add(new DateInterval("P7D"));

        $token = (new Token())
            ->setUser($user)
            ->setToken(Generator::generateToken())
            ->setExpiresAt($expiresAt);

        $this->getManager()->persist($token);
        $this->getManager()->flush();

        return $token;
    }

    public function deleteExpiresTokens()
    {

    }
}
