<?php

namespace AppBundle\Controller\Api;

use AppBundle\Entity\Callback;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;

/**
 * @Route("/callback")
 */
class CallbackController extends Controller
{
    /**
     * New callback
     *
     * @Rest\Get("/new", name="api.callback.new")
     *
     * @param Request $request
     *
     * @return Response
     */
    public function getAction(Request $request)
    {
        $callback = new Callback();

        $callback->setName($request->get('name'));
        $callback->setPhone($request->get('phone'));
        $em = $this->getDoctrine()->getManager();

        try {
            $em->persist($callback);
            $em->flush();
            $stat = $this->get('app.service.email_notification')->sendAdminNotificationCallback($callback);
        } catch (\Exception $e) {
            return Response::HTTP_NO_CONTENT;
        }

        return Response::HTTP_OK;
    }

}
