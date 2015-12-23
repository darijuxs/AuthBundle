<?php

namespace AuthBundle\Entity\User\Exception;

use AuthBundle\Exception\AuthenticationException;

/**
 * Class UserNotFoundException
 * @package AuthBundle\Entity\User\Exception
 */
class UserNotFoundException extends AuthenticationException
{
    /**
     * UserNotFoundException constructor.
     * @param string $name
     */
    public function __construct($name)
    {
        parent::__construct(sprintf('User "%s" not found.', $name));
    }
}
