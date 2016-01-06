<?php

namespace AuthBundle\Exception;

use AuthBundle\Entity\User\User;

/**
 * Class AccessDeniedException
 * @package AuthBundle\Exception
 */
class AccessDeniedException extends AuthException
{
    /**
     * PermissionDenied constructor.
     * @param User $user
     * @param int $route
     */
    public function __construct(User $user, $route)
    {
        parent::__construct(sprintf('User "%s" does not have permission for  "%s" route.', $user->getUsername(), $route));
    }
}
