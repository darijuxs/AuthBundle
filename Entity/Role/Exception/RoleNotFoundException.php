<?php

namespace AuthBundle\Entity\Role\Exception;

use AuthBundle\Exception\AuthenticationException;

/**
 * Class RoleNotFoundException
 * @package AuthBundle\Entity\Role\Exception
 */
class RoleNotFoundException extends AuthenticationException
{
    /**
     * RoleNotFoundException constructor.
     * @param string $name
     */
    public function __construct($name)
    {
        parent::__construct(sprintf('Role "%s" not found.', $name));
    }
}
