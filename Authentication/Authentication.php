<?php

namespace AuthBundle\Authentication;

use RAPIBundle\Request\Request;
use AuthBundle\Authentication\Exception\InterfaceNotImplemented;
use AuthBundle\Authentication\Model\User\Exception\UserNotFoundException;
use AuthBundle\Authentication\Model\User\UserInterface;
use AuthBundle\Authentication\Model\User\UserRepositoryInterface;

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
     * @var UserRepositoryInterface
     */
    private $userRepository;

    /**
     * @var UserInterface
     */
    private $user;

    /**
     * Authentication constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @param $currentUser
     * @throws InterfaceNotImplemented
     */
    public function setCurrentUserManager($currentUser)
    {
        if (!class_exists($currentUser)) {
//            @todo implement exception
        }

        $this->userRepository = $this
            ->getManager()
            ->getRepository($currentUser);

        if (!$this->userRepository instanceof UserRepositoryInterface) {
            throw new InterfaceNotImplemented(UserRepositoryInterface::class, get_class($this->user));
        }
    }

    /**
     * @return UserInterface|null
     * @throws UserNotFoundException
     */
    public function login()
    {
        $user = $this
            ->userRepository
            ->findOneByToken($this->request->get("token"));

        if ($user instanceof UserInterface) {
            return $user;
        }

        throw new UserNotFoundException();
    }
}
