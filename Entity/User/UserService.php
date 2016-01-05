<?php

namespace AuthBundle\Entity\User;

use AuthBundle\Authentication\DoctrineManager;
use AuthBundle\Entity\Role\Role;
use AuthBundle\Entity\Role\RoleRepository;
use AuthBundle\Entity\Token\TokenService;
use AuthBundle\Exception\RoleNotFoundException;
use AuthBundle\Exception\UserExistsException;
use AuthBundle\Helper\Generator;

/**
 * Class UserService
 * @package AuthBundle\Entity\User
 */
class UserService extends DoctrineManager
{
    /**
     * @var UserRepository
     */
    private $userRepo;

    /**
     * @var RoleRepository
     */
    private $roleRepo;

    /**
     * @var string
     */
    private $secret;

    /**
     * @var TokenService
     */
    private $tokenService;

    /**
     * UserService constructor.
     * @param TokenService $tokenService
     * @param $secret
     */
    public function __construct(TokenService $tokenService, $secret)
    {
        $this->secret = $secret;
        $this->tokenService = $tokenService;
    }

    public function init()
    {
        $this->roleRepo = $this->getManager()->getRepository(Role::class);
        $this->userRepo = $this->getManager()->getRepository(User::class);
    }

    /**
     * @param $username
     * @param $password
     * @param $roleName
     * @return User|null
     * @throws RoleNotFoundException
     * @throws UserExistsException
     */
    public function create($username, $password, $roleName)
    {
        $role = $this->roleRepo->findOneByName($roleName);
        if (!$role instanceof Role) {
            throw new RoleNotFoundException($roleName);
        }

        $user = $this->userRepo->findOneByUsername($username);
        if ($user instanceof User) {
            throw new UserExistsException($username);
        }

        $salt = Generator::generateSalt();
        $encryptedPassword = Generator::hash($salt, $this->secret, $password);

        $user = (new User())
            ->setUsername($username)
            ->setPassword($encryptedPassword)
            ->setRole($role)
            ->setSalt($salt)
            ->setDeleted(false)
            ->setActive(true);

        $this->getManager()->persist($user);

        $this->tokenService->create($user);
        $this->getManager()->flush();

        return $user;
    }
}
