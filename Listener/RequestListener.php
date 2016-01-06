<?php

namespace AuthBundle\Listener;

use AuthBundle\Authentication\Authentication;
use AuthBundle\Entity\Access\AccessService;
use AuthBundle\Entity\User\User;
use AuthBundle\Exception\AccessDeniedException;
use AuthBundle\Exception\InvalidRouteException;
use AuthBundle\Exception\UserNotFoundException;
use RAPIBundle\Request\Request;
use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\Routing\Route;

/**
 * Class RequestListener
 * @package AuthBundle\Listener
 */
class RequestListener
{
    /**
     * @var RequestStack
     */
    private $request;

    /**
     * @var Router
     */
    private $router;

    /**
     * @var Authentication
     */
    private $authentication;

    /**
     * @var AccessService
     */
    private $accessService;

    /**
     * RequestListener constructor.
     * @param Request $request
     * @param Router $router
     * @param Authentication $authentication
     * @param AccessService $accessService
     */
    public function __construct(Request $request, Router $router, Authentication $authentication, AccessService $accessService)
    {
        $this->request = $request;
        $this->router = $router;
        $this->authentication = $authentication;
        $this->accessService = $accessService;
    }

    /**
     * Check request to decide if user has access to specific route
     *
     * @param GetResponseEvent $event
     * @throws AccessDeniedException
     * @throws InvalidRouteException
     * @throws UserNotFoundException
     */
    public function onKernelRequest(GetResponseEvent $event)
    {
        $routeName = $event->getRequest()->get("_route");
        if (strpos($routeName, "app_default_") === 0) {
            throw new InvalidRouteException();
        }

        $routeCollection = $this->router->getRouteCollection();
        $route = $routeCollection->get($routeName);

        if ($route instanceof Route) {
            //Check if need to validate route
            //Sometime we want to allow access without validation: index page, login page
            $accessValidation = $route->getOption('access_validation');
            if ($accessValidation === false) {
                return;
            }

            //Validate current user access to route
            $this->authentication->setCurrentUser($this->request->get("token"));
            $user = $this->authentication->getCurrentUser();
            if (!$user instanceof User) {
                throw new UserNotFoundException();
            }

            $access = $this->accessService->checkPermissions($user, $routeName);
            if ($access === false) {
                throw new AccessDeniedException($user, $routeName);
            }
        }
    }
}
