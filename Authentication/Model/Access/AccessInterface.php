<?php

namespace AuthBundle\Authentication\Model\Access;

use AuthBundle\Authentication\Model\Role\RoleInterface;
use AuthBundle\Authentication\Model\User\UserInterface;

/**
 * Interface AccessInterface
 * @package AuthBundle\Authentication\Model\Access
 */
interface AccessInterface
{
    /**
     * @return string
     */
    public function getRoute();

    /**
     * @return UserInterface|null
     */
    public function getUser();

    /**
     * @return RoleInterface|null
     */
    public function getRole();
}
