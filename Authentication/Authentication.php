<?php

namespace AuthBundle\Authentication;

use AuthBundle\Authentication\CurrentUser\CurrentUser;
use AuthBundle\Authentication\Interfaces\CurrentUserInterface;
use RAPIBundle\Request\Request;

/**
 * Class Authentication
 * @package AuthBundle\Authentication
 */
class Authentication
{
    private $request;

    private $currentUser;

    public function __construct(Request $request, CurrentUser $currentUser)
    {
        $this->currentUser = $currentUser;
    }

    public function login()
    {
        return $this->currentUser->getUserByUsername("d");
    }
}
