<?php

namespace AuthBundle\Exception;

/**
 * Class RoleNotFoundException
 * @package AuthBundle\Exception
 */
class RoleNotFoundException extends AuthException
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
