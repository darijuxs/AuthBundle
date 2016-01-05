<?php

namespace AuthBundle\Controller;

use AuthBundle\Exception\AuthException;
use AuthBundle\Entity\User\UserFilter;
use RAPIBundle\Controller\RAPIController;
use RAPIBundle\Response\HttpStatusCode;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Class LoginController
 * @package AuthBundle\Controller
 */
class LoginController extends RAPIController
{
    /**
     * @Route("/login/", name="auth_login")
     */
    public function loginAction()
    {
        try {
            $user = $this->get("auth.login")->login();
        } catch (AuthException $e) {
            return $this->getResponse()
                ->setStatusCode(HttpStatusCode::HTTP_UNAUTHORIZED)
                ->setError($e->getMessage())
                ->get();
        }

        return $this->getResponse()
            ->setResult($this->getDataMapper()->map($user, UserFilter::loginFilter(), 3))
            ->get();

    }
}
