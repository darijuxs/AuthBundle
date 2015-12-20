<?php

namespace AuthBundle\Authentication\Exception;

use Exception;

/**
 * Class InterfaceNotImplemented
 * @package AuthBundle\Authentication\Exception
 */
class InterfaceNotImplemented extends Exception
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
