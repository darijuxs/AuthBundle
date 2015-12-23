<?php

namespace AuthBundle\Entity\Role;

use Doctrine\ORM\EntityRepository;

/**
 * Class RoleRepository
 * @package AuthBundle\Entity\Role
 */
class RoleRepository extends EntityRepository
{
    /**
     * @param $name
     * @return null|Role
     */
    public function findOneByName($name)
    {
        return $this->findOneBy(["name" => $name]);
    }
}
