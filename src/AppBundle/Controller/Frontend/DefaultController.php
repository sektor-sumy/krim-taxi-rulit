<?php

namespace AppBundle\Controller\Frontend;

use AppBundle\Entity\City;
use AppBundle\Entity\TransportClass;
use AppBundle\Entity\TransportIntercity;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

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
        $cityIn = $this->getDoctrine()->getRepository(City::class)->getFromByActiveTransportIntercity();

        return $this->render('frontend/homepage.html.twig', [
            'transportIntercityes' => $transportIntercityes,
            'transportClasses' => $transportClasses,
            'cityFrom' => $cityFrom,
            'cityIn' => $cityIn
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
