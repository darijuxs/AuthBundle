<?php

namespace AuthBundle\Entity\Access;

use AuthBundle\Authentication\DoctrineManager;
use AuthBundle\Entity\Role\Role;
use AuthBundle\Entity\Role\RoleRepository;
use AuthBundle\Entity\User\User;
use AuthBundle\Entity\User\UserRepository;
use AuthBundle\Exception\RoleNotFoundException;
use AuthBundle\Exception\UserNotFoundException;

/**
 * Class AccessService
 * @package AuthBundle\Entity\Access
 */
class AccessService extends DoctrineManager
{
    const ACCESS_BY_USER = "user";
    const ACCESS_BY_ROLE = "role";

    /**
     * @var AccessRepository
     */
    private $accessRepo;

    /**
     * @var RoleRepository
     */
    private $roleRepo;

    /**
     * @var UserRepository
     */
    private $userRepo;

    public function init()
    {
        $this->accessRepo = $this->getManager()->getRepository(Access::class);
        $this->roleRepo = $this->getManager()->getRepository(Role::class);
        $this->userRepo = $this->getManager()->getRepository(User::class);
    }

    /**
     * Create access rule. To create access successfully $role or $username should be declared
     *
     * @param $route
     * @param $type - should be "role" or "user"
     * @param $value - should be role name or user name
     * @return Access|null
     * @throws RoleNotFoundException
     * @throws UserNotFoundException
     */
    public function create($route, $type, $value)
    {
        if ($type === self::ACCESS_BY_ROLE) {
            $role = $this->roleRepo->findOneByName($value);
            if ($role instanceof Role) {
                $access = (new Access())
                    ->setRole($role)
                    ->setRoute($route);

                $this->getManager()->persist($access);
                $this->getManager()->flush();

                return $access;
            }

            throw new RoleNotFoundException($value);
        }

        if ($type === self::ACCESS_BY_USER) {
            $user = $this->userRepo->findOneByUsername($value);
            if ($user instanceof User) {
                $access = (new Access())
                    ->setUser($user)
                    ->setRoute($route);

                $this->getManager()->persist($access);
                $this->getManager()->flush();

                return $access;
            }

            throw new UserNotFoundException($value);
        }

        return null;
    }

    /**
     * Check if user has permission to access specific route
     *
     * @param User $user
     * @param $route
     * @return bool
     */
    public function checkPermissions(User $user, $route)
    {
        //Check if access exists for current role
        $roleAccesses = $user->getRole()->getAccesses();
        foreach ($roleAccesses as $access) {
            if ($access->getRoute() === $route) {
                return true;
            }
        }

        //Check is access exists for particular user
        $userAccesses = $user->getAccesses();
        foreach ($userAccesses as $access) {
            if ($access->getRoute() === $route) {
                return true;
            }
        }

        return false;
    }
}
