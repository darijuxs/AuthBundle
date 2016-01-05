<?php

namespace AuthBundle\Exception;

/**
 * Class RoleExistsException
 * @package AuthBundle\Exception
 */
class RoleExistsException extends AuthException
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
