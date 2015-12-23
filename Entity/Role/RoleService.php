<?php

namespace AuthBundle\Entity\Role;

use AuthBundle\Authentication\DoctrineManager;
use AuthBundle\Entity\Role\Exception\RoleExistsException;

/**
 * Class RoleService
 * @package AuthBundle\Entity\Role
 */
class RoleService extends DoctrineManager
{
    /**
     * @var RoleRepository
     */
    private $roleRepo;

    public function init()
    {
        $this->roleRepo = $this
            ->getManager()
            ->getRepository(Role::class);
    }

    /**
     * Create role
     *
     * @param $name
     * @return Role|null
     * @throws RoleExistsException
     */
    public function create($name)
    {
        $role = $this->roleRepo->findOneByName($name);
        if ($role instanceof Role) {
            throw new RoleExistsException($role->getName());
        }

        $role = (new Role())
            ->setName($name);

        $this->getManager()->persist($role);
        $this->getManager()->flush();

        return $role;
    }
}
