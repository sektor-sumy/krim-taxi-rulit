<?php

namespace AppBundle\Controller\Api;

use AppBundle\Entity\Message;
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
 * @Route("/message")
 */
class MessageController extends Controller
{
    /**
     * New message
     *
     * @Rest\Get("/new", name="api.message.new")
     *
     * @param Request $request
     *
     * @return Response
     */
    public function getAction(Request $request)
    {
        $message = new Message();

        $message->setName($request->get('name'));
        $message->setEmail($request->get('email'));
        $message->setPhone($request->get('phone'));
        $message->setText($request->get('text'));
        $em = $this->getDoctrine()->getManager();

        try {
            $em->persist($message);
            $em->flush();
        } catch (\Exception $e) {
            dump($e); die;
            return Response::HTTP_NO_CONTENT;
        }

        return Response::HTTP_OK;
    }

}
