<?php

namespace AppBundle\Controller\Frontend;

use AppBundle\Entity\City;
use AppBundle\Entity\TransportClass;
use AppBundle\Entity\TransportIntercity;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
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
        $cityIn = $this->getDoctrine()->getRepository(City::class)->getFromByActiveTransportIntercity();



        $message = new Message();
        $formMessage = $this->createForm('AppBundle\Form\MessageType', $message);
        $formMessage->handleRequest($request);


        return $this->render('frontend/homepage.html.twig', [
            'transportIntercityes' => $transportIntercityes,
            'transportClasses' => $transportClasses,
            'cityFrom' => $cityFrom,
            'cityIn' => $cityIn,
            'formMessage' => $formMessage->createView()
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
