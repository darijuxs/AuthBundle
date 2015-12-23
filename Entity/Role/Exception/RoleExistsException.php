<?php

namespace AuthBundle\Entity\Role\Exception;

use AuthBundle\Exception\AuthenticationException;

/**
 * Class RoleExistsException
 * @package AuthBundle\Entity\Role\Exception
 */
class RoleExistsException extends AuthenticationException
{
    /**
     * RoleExistsException constructor.
     * @param string $name
     */
    public function __construct($name)
    {
        parent::__construct(sprintf('Role "%s" already exists.', $name));
    }
}
