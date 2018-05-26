<?php

namespace AppBundle\Controller\Frontend;

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
        // replace this example code with whatever you need
        return $this->render('frontend/homepage.html.twig');
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
