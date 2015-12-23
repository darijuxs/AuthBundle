<?php

namespace AuthBundle\Entity\User\Exception;

use AuthBundle\Exception\AuthenticationException;

/**
 * Class UserExistsException
 * @package AuthBundle\Entity\User\Exception
 */
class UserExistsException extends AuthenticationException
{
    /**
     * UserNotFoundException constructor.
     * @param string $name
     */
    public function __construct($name)
    {
        parent::__construct(sprintf('User "%s" already exists.', $name));
    }
}
