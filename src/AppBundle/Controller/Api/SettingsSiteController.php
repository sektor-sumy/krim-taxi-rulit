<?php

namespace AppBundle\Controller\Api;

use AppBundle\Entity\Callback;
use AppBundle\Entity\SettingsSite;
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
 * @Route("/information")
 */
class SettingsSiteController extends Controller
{
    /**
     * @Rest\Get("/", name="api.information")
     *
     * @param Request $request
     *
     * @return Response
     */
    public function getAction(Request $request)
    {
        $information = $this->getDoctrine()->getManager()->getRepository(SettingsSite::class)->getActive();

        return $information[0];
    }

}
