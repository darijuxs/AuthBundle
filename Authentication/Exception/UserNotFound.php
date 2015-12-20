<?php

namespace AuthBundle\Authentication\Exception;

use Exception;

/**
 * Class UserNotFound
 * @package AuthBundle\Authentication\Exception
 */
class UserNotFound extends Exception
{
    /**
     * UserNotFound constructor.
     * @param null|string $username
     */
    public function __construct($username = null)
    {
        if ($username) {
            $message = sprintf('User "%s" not found', $username);
        } else {
            $message = sprintf('User not found');
        }

        parent::__construct($message);
    }
}
