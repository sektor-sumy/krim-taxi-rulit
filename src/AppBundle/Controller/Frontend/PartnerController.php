<?php

namespace AppBundle\Controller\Frontend;

use AppBundle\Entity\Partner;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * @Route("/partner")
 */
class PartnerController extends Controller
{
    /**
     * @Route("/{id}", name="frontend.partner.page")
     *
     * @param Request $request
     * @param Partner $partner
     *
     * @return RedirectResponse|Response
     */
    public function pagePartnerAction(Request $request, Partner $partner)
    {
        return $this->render('frontend/partner/page.html.twig', [
            'partner' => $partner
        ]);
    }
}
