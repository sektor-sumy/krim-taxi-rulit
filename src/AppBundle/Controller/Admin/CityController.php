<?php

namespace AppBundle\Controller\Admin;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class CityController
 * @Route("/city")
 */
class CityController extends Controller
{
    /**
     * @Route("/", name="admin.city")
     */
    public function indexAction(Request $request)
    {
        return $this->render('admin/city/list.html.twig');
    }
}
