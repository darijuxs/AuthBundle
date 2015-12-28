<?php

namespace AuthBundle\Authentication\Model\Role;

/**
 * Interface RoleRepositoryInterface
 * @package AuthBundle\Authentication\Model\Role
 */
interface RoleRepositoryInterface
{
    /**
     * @param $name - string
     * @return RoleInterface|null
     */
    public function findOneByName($name);
}
