<?php

namespace AuthBundle\Exception;

/**
 * Class InvalidRouteException
 * @package AuthBundle\Exception
 */
class InvalidRouteException extends AuthException
{
    /**
     * InvalidRouteException constructor.
     */
    public function __construct()
    {
        parent::__construct(sprintf('Route "name" is not presented'));
    }
}
