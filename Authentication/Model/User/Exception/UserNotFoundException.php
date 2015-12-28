<?php

namespace AuthBundle\Authentication\Model\User\Exception;

use AuthBundle\Exception\AuthenticationException;

/**
 * Class UserNotFoundException
 * @package AuthBundle\Model\User\Exception
 */
class UserNotFoundException extends AuthenticationException
{
    /**
     * UserNotFoundException constructor.
     * @param string $name
     */
    public function __construct($name = null)
    {
        if ($name === null) {
            parent::__construct(sprintf('User not found.', $name));
            return;
        }

        parent::__construct(sprintf('User "%s" not found.', $name));
    }
}
