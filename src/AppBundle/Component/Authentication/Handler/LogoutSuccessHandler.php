<?php

namespace AppBundle\Component\Authentication\Handler;

use Symfony\Component\Security\Http\Logout\LogoutSuccessHandlerInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Routing\Router;

/**
 * Class LogoutSuccessHandler
 */
class LogoutSuccessHandler implements LogoutSuccessHandlerInterface
{
    /**
     * @var Router
     */
    protected $router;

    /**
     * LogoutSuccessHandler constructor.
     * @param Router $router
     */
    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    /**
     * @param Request $request
     *
     * @return RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function onLogoutSuccess(Request $request)
    {
        $refererUrl = $request->headers->get('referer');

        $response = new RedirectResponse($refererUrl);

        return $response;
    }
}