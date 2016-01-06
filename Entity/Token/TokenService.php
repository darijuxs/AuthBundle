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

    /**
     * @var bool
     */
    private $multipleTokens;

    /**
     * @param bool $multipleTokens
     */
    public function init($multipleTokens)
    {
        $this->tokenRepo = $this
            ->getManager()
            ->getRepository(Token::class);

        $this->multipleTokens = (bool) $multipleTokens;
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

        $this->deleteExpiresTokens($user);

        return $token;
    }

    /**
     * Delete tokens.
     * If setting "multiple_token" is false then leave only one token in database. Last token.
     * If setting "multiple_token" is true then delete only expired tokens
     *
     * @param User $user
     */
    public function deleteExpiresTokens(User $user)
    {
        if ($this->multipleTokens === true) {
            $tokens = $this->tokenRepo->findExpiresTokenByUser($user);
        } else {
            $tokens = $this->tokenRepo->findAllByUser($user);
        }

        foreach ($tokens as $token) {
            //Don't delete last token if required only one token
            if ($this->multipleTokens === false and end($tokens) === $token) {
                continue;
            }

            $this->getManager()->remove($token);
        }

        $this->getManager()->flush();
    }
}
