<?php

namespace AuthBundle\Exception;

/**
 * Class UserNotFoundException
 * @package AuthBundle\Exception
 */
class UserNotFoundException extends AuthException
{
    /**
     * UserNotFoundException constructor.
     * @param null $name
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
