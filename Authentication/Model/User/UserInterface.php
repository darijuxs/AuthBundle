<?php

namespace AuthBundle\Authentication\Model\User;

use DateTime;
use AuthBundle\Authentication\Model\Token\TokenInterface;
use AuthBundle\Authentication\Model\Access\AccessInterface;
use AuthBundle\Authentication\Model\Role\RoleInterface;

/**
 * Interface UserInterface
 * @package AuthBundle\Authentication\Model\User
 */
interface UserInterface
{
    /**
     * @return int|string
     */
    public function getId();

    /**
     * @return string
     */
    public function getUsername();

    /**
     * @return string
     */
    public function getPassword();

    /**
     * @return string
     */
    public function getSalt();

    /**
     * @return string
     */
    public function getEmail();

    /**
     * @return bool
     */
    public function isActive();

    /**
     * @return bool
     */
    public function isDeleted();

    /**
     * @return DateTime
     */
    public function getCreatedAt();

    /**
     * @return DateTime
     */
    public function getUpdatedAt();

    /**
     * @return TokenInterface[]
     */
    public function getTokens();

    /**
     * @return AccessInterface[]
     */
    public function getAccesses();

    /**
     * @return RoleInterface
     */
    public function getRole();
}
