<?php

namespace AuthBundle\Exception;

/**
 * Class UserExistsException
 * @package AuthBundle\Exception
 */
class UserExistsException extends AuthException
{
    /**
     * UserExistsException constructor.
     * @param string $name
     */
    public function __construct($name)
    {
        parent::__construct(sprintf('User "%s" already exists.', $name));
    }
}
