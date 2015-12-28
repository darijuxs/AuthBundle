<?php

namespace AuthBundle\Authentication\Exception;

use AuthBundle\Exception\AuthenticationException;

/**
 * Class InterfaceNotImplemented
 * @package AuthBundle\Authentication\Exception
 */
class InterfaceNotImplemented extends AuthenticationException
{
    /**
     * InterfaceNotImplemented constructor.
     * @param string $interface
     * @param string $class
     */
    public function __construct($interface, $class)
    {
        $message = sprintf('Interface "%s" should be implemented on class %s', $interface, $class);

        parent::__construct($message);
    }
}
