<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Entity\Message;
use Doctrine\Common\Collections\ArrayCollection;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
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
     * @Route("/", name="admin.message")
     */
    public function indexAction(Request $request)
    {
        $messages = $this->getDoctrine()->getRepository(Message::class)->findAllOrderByCreatedAt();//findBy(['removedAt'=>''], ['createdAt' => 'DESC']);

        return $this->render('admin/message/list.html.twig', [
            'messages' => $messages,
        ]);
    }

    /**
     * @Route("/viewed/{message}", name="admin.message.viewed")
     *
     * @param Request $request
     * @param Message $message
     *
     * @ParamConverter("message", class="AppBundle:Message")
     *
     * @return RedirectResponse
     */
    public function viewedAction(Request $request, Message $message)
    {
        $em = $this->getDoctrine()->getManager();

        $message->setViewedAt(true);
        try {
            $em->persist($message);
            $em->flush();
        } catch (\Exception $e) {
            $this->get('logger')->error($e, ['exception' => $e]);
            $this->addFlash('error', $this->get('translator')->trans('Unexpected error occurred.'));
        }

        return $this->redirectToRoute('admin.message');
    }

    /**
     * @Route("/delete/{message}", name="admin.message.delete")
     *
     * @param Request $request
     * @param Message $message
     *
     * @ParamConverter("message", class="AppBundle:Message")
     *
     * @return RedirectResponse
     */
    public function deleteAction(Request $request, Message $message)
    {
        $em = $this->getDoctrine()->getManager();

        try {
            $em->remove($message);
            $em->flush();
        } catch (\Exception $e) {
            $this->get('logger')->error($e, ['exception' => $e]);
            $this->addFlash('error', $this->get('translator')->trans('Unexpected error occurred.'));
        }

        return $this->redirectToRoute('admin.message');
    }


    /**
     * @Rest\Get("/count-new", name="api.message.count.new")
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function getCountNewAction(Request $request)
    {
        $count = $this->getDoctrine()->getRepository(Message::class)->getCountNew();

        return new JsonResponse(['count'=>$count[0][1]]);
    }

}
