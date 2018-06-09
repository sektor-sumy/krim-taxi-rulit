<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Entity\Callback;
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
 * @Route("/callback")
 */
class CallbackController extends Controller
{
    /**
     * @Route("/", name="admin.callback")
     */
    public function indexAction(Request $request)
    {
        $callbacks = $this->getDoctrine()->getRepository(Callback::class)->findAllOrderByCreatedAt();//findBy(['removedAt'=>''], ['createdAt' => 'DESC']);

        return $this->render('admin/callback/list.html.twig', [
            'callbacks' => $callbacks,
        ]);
    }

    /**
     * @Route("/viewed/{callback}", name="admin.callback.viewed")
     *
     * @param Request $request
     * @param Callback $callback
     *
     * @ParamConverter("callback", class="AppBundle:Callback")
     *
     * @return RedirectResponse
     */
    public function viewedAction(Request $request, Callback $callback)
    {
        $em = $this->getDoctrine()->getManager();

        $callback->setViewedAt(true);
        try {
            $em->persist($callback);
            $em->flush();
        } catch (\Exception $e) {
            $this->get('logger')->error($e, ['exception' => $e]);
            $this->addFlash('error', $this->get('translator')->trans('Unexpected error occurred.'));
        }

        return $this->redirectToRoute('admin.callback');
    }

    /**
     * @Route("/delete/{callback}", name="admin.callback.delete")
     *
     * @param Request $request
     * @param Callback $callback
     *
     * @ParamConverter("callback", class="AppBundle:Callback")
     *
     * @return RedirectResponse
     */
    public function deleteAction(Request $request, Callback $callback)
    {
        $em = $this->getDoctrine()->getManager();

        try {
            $em->remove($callback);
            $em->flush();
        } catch (\Exception $e) {
            $this->get('logger')->error($e, ['exception' => $e]);
            $this->addFlash('error', $this->get('translator')->trans('Unexpected error occurred.'));
        }

        return $this->redirectToRoute('admin.callback');
    }

    /**
     * @Rest\Get("/count-new", name="api.callback.count.new")
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function getCountNewAction(Request $request)
    {
        $count = $this->getDoctrine()->getRepository(Callback::class)->getCountNew();

        return new JsonResponse(['count'=>$count[0][1]]);
    }
}
