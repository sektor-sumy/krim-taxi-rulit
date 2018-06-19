<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Entity\Message;
use AppBundle\Entity\OrderCar;
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
 * @Route("/order-car")
 */
class OrderCarController extends Controller
{
    /**
     * @Route("/", name="admin.order-car")
     */
    public function indexAction(Request $request)
    {
        $orders = $this->getDoctrine()->getRepository(OrderCar::class)->findAll();

        return $this->render('admin/order-car/list.html.twig', [
            'orders' => $orders,
        ]);
    }

    /**
     * @Route("/viewed/{order}", name="admin.order-car.viewed")
     *
     * @param Request $request
     * @param OrderCar $order
     *
     * @ParamConverter("order", class="AppBundle:OrderCar")
     *
     * @return RedirectResponse
     */
    public function viewedAction(Request $request, OrderCar $order)
    {
        $em = $this->getDoctrine()->getManager();

        $order->setViewedAt(true);
        try {
            $em->persist($order);
            $em->flush();
        } catch (\Exception $e) {
            $this->get('logger')->error($e, ['exception' => $e]);
            $this->addFlash('error', $this->get('translator')->trans('Unexpected error occurred.'));
        }

        return $this->redirectToRoute('admin.order-car');
    }

    /**
     * @Route("/delete/{order}", name="admin.order-car.delete")
     *
     * @param Request $request
     * @param  OrderCar $order
     *
     * @ParamConverter("order", class="AppBundle:OrderCar")
     *
     * @return RedirectResponse
     */
    public function deleteAction(Request $request, OrderCar $order)
    {
        $em = $this->getDoctrine()->getManager();

        try {
            $em->remove($order);
            $em->flush();
        } catch (\Exception $e) {
            $this->get('logger')->error($e, ['exception' => $e]);
            $this->addFlash('error', $this->get('translator')->trans('Unexpected error occurred.'));
        }

        return $this->redirectToRoute('admin.order-car');
    }


    /**
     * @Rest\Get("/count-new", name="api.order-car.count.new")
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function getCountNewAction(Request $request)
    {
        $count = $this->getDoctrine()->getRepository(OrderCar::class)->getCountNew();

        return new JsonResponse(['count'=>$count[0][1]]);
    }

}
