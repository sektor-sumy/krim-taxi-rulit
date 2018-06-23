<?php

namespace AppBundle\Controller\Frontend;

use AppBundle\Entity\City;
use AppBundle\Entity\OrderCar;
use AppBundle\Entity\Partner;
use AppBundle\Entity\TransportClass;
use AppBundle\Entity\TransportIntercity;
use AppBundle\Form\PartnerType;
use AppBundle\Repository\PartnerRepository;
use http\Env\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Message;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="frontend.main")
     */
    public function indexAction(Request $request)
    {
        $transportIntercityes = $this->getDoctrine()->getRepository(TransportIntercity::class)->findAll();

        $transportClasses = $this->getDoctrine()->getRepository(TransportClass::class)->getByActiveTransportIntercity();

        $cityFrom = $this->getDoctrine()->getRepository(City::class)->getFromByActiveTransportIntercity();
        $cityIn = $this->getDoctrine()->getRepository(City::class)->getInByActiveTransportIntercity();

        return $this->render('frontend/homepage.html.twig', [
            'transportIntercityes' => $transportIntercityes,
            'transportClasses' => $transportClasses,
            'cityFrom' => $cityFrom,
            'cityIn' => $cityIn
        ]);
    }


    /**
     * @Route("/price", name="frontend.price")
     */
    public function priceAction(Request $request)
    {
        $transportIntercityes = $this->getDoctrine()->getRepository(TransportIntercity::class)->findAll();
        $transportClasses = $this->getDoctrine()->getRepository(TransportClass::class)->getByActiveTransportIntercity();
        $cityFrom = $this->getDoctrine()->getRepository(City::class)->getFromByActiveTransportIntercity();
        $cityIn = $this->getDoctrine()->getRepository(City::class)->getInByActiveTransportIntercity();


        return $this->render('frontend/price.html.twig', [
            'transportIntercityes' => $transportIntercityes,
            'transportClasses' => $transportClasses,
            'cityFrom' => $cityFrom,
            'cityIn' => $cityIn
        ]);
    }

    /**
     * @Route("/cars", name="frontend.cars")
     *
     * @param Request $request
     *
     * @return RedirectResponse|Response
     */
    public function carsAction(Request $request)
    {
        $orderCar = new OrderCar();
        $form = $this->createForm('AppBundle\Form\OrderCarType', $orderCar);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $orderCar = $form->getData();

            try {
                $em->persist($orderCar);
                $em->flush();
                $stat = $this->get('app.service.email_notification')->sendAdminNotificationOrderCar($orderCar);

            } catch (\Exception $e) {
                dump($e); die;
                $this->get('logger')->error($e, ['exception' => $e]);
                $this->addFlash('error', $this->get('translator')->trans('Unexpected error occurred.'));
            }

            return $this->redirectToRoute('frontend.cars');
        }


        return $this->render('frontend/cars.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/partners", name="frontend.partners")
     */
    public function partnersAction(Request $request)
    {
        $partners = $this->getDoctrine()->getRepository(Partner::class)->getAllActive();

        return $this->render('frontend/partners.html.twig', [
            'partners' => $partners,
        ]);
    }

    /**
     * @Route("/contact", name="frontend.contact")
     */
    public function contactAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('frontend/contact.html.twig');
    }
}
