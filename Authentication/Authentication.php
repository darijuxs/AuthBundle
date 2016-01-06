<?php

namespace AuthBundle\Authentication;

use AuthBundle\Entity\Token\TokenService;
use AuthBundle\Entity\User\User;
use AuthBundle\Entity\User\UserRepository;
use AuthBundle\Exception\UserNotFoundException;
use AuthBundle\Helper\Generator;
use RAPIBundle\Request\Request;

/**
 * Class Authentication
 * @package AuthBundle\Authentication
 */
class Authentication extends DoctrineManager
{
    /**
     * @var Request
     */
    private $request;

    /**
     * @var string
     */
    private $secret;

    /**
     * @var TokenService
     */
    private $tokenService;

    /**
     * @var UserRepository
     */
    private $userRepo;

    /**
     * @var User
     */
    private $currentUser;

    /**
     * Authentication constructor.
     * @param Request $request
     * @param TokenService $tokenService
     * @param $secret
     */
    public function __construct(Request $request, TokenService $tokenService, $secret)
    {
        $this->request = $request;
        $this->tokenService = $tokenService;
        $this->secret = $secret;
    }

    public function init()
    {
        $this->userRepo = $this
            ->getManager()
            ->getRepository(User::class);
    }

    /**
     * @return User|null
     * @throws UserNotFoundException
     */
    public function login()
    {
        $username = $this->request->get('username');

        $user = $this->userRepo->findOneByUsername($username);
        if (!$user instanceof User) {
            throw new UserNotFoundException($username);
        }

        $encryptedPassword = Generator::hash($user->getSalt(), $this->secret, $this->request->get('password'));
        if ($encryptedPassword !== $user->getPassword()) {
            throw new UserNotFoundException($username);
        }

        $this->tokenService->create($user);

        return $user;
    }

    /**
     * Set current user
     *
     * @param $token
     * @return User|null
     */
    public function setCurrentUser($token)
    {
        if ($this->currentUser instanceof User) {
            return $this;
        }

        $this->currentUser = $this->userRepo->findOneByToken($token);

        return $this;
    }

    /**
     * Get current user
     *
     * @return User
     */
    public function getCurrentUser()
    {
        return $this->currentUser;
    }
}
