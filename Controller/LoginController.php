<?php

namespace AuthBundle\Controller;

use Exception;
use RAPIBundle\Controller\RAPIController;
use RAPIBundle\Response\HttpStatusCode;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class LoginController extends RAPIController
{
    /**
     * @Route("/login/", name="auth_login")
     */
    public function loginAction()
    {
        try {
            $user = $this->get("auth.login")->login();
        } catch (Exception $e) {
            return $this->getResponse()
                ->setStatusCode(HttpStatusCode::HTTP_UNAUTHORIZED)
                ->setError($e->getMessage())
                ->get();
        }

        return $this->getResponse()
            ->setResult($this->getDataMapper()->map($user))
            ->get();

    }
}
