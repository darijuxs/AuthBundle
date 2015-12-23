<?php

namespace AuthBundle\Entity\User;

use AuthBundle\Authentication\DoctrineManager;
use AuthBundle\Entity\Role\Exception\RoleNotFoundException;
use AuthBundle\Entity\Role\Role;
use AuthBundle\Entity\Role\RoleRepository;
use AuthBundle\Entity\User\Exception\UserExistsException;

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
     * UserService constructor.
     * @param $secret
     */
    public function __construct($secret)
    {
        $this->secret = $secret;
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


        $salt = uniqid(mt_rand(), true);
        $token = md5(uniqid("", true));

        $encryptedPassword = hash('sha512', $salt . $this->secret . $password);


        $user = (new User())
            ->setUsername($username)
            ->setPassword($encryptedPassword)
            ->setRole($role)
            ->setSalt($salt)
            ->setDeleted(false)
            ->setActive(true);

        $this->getManager()->persist($user);
        $this->getManager()->flush();

        return $user;
//        if ($type === self::ACCESS_BY_USER) {
//            $user = $this->userRepo->findOneByUsername($value);
//            if ($user instanceof User) {
//                $access = (new Access())
//                    ->setUser($user)
//                    ->setRoute($route);
//
//                $this->getManager()->persist($access);
//                $this->getManager()->flush();
//
//                return $access;
//            }
//
//            throw new UserNotFoundException($value);
//        }
//
//        return null;
    }
}
