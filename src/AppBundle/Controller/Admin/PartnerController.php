<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Entity\Partner;
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
 * Class PartnerController
 * @Route("/partner")
 */
class PartnerController extends Controller
{
    /**
     * @Route("/", name="admin.partner")
     */
    public function indexAction(Request $request)
    {
        $partners = $this->getDoctrine()->getRepository(Partner::class)->findAll();

        return $this->render('admin/partner/list.html.twig', [
            'partners' => $partners
        ]);
    }


    /**
     * Creates a new partner entity.
     *
     * @Route("/new", name="admin.partner.new")
     *
     * @param Request $request
     *
     * @return RedirectResponse|Response
     */
    public function newAction(Request $request)
    {
        $partner = new Partner();
        $form = $this->createForm('AppBundle\Form\PartnerType', $partner);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $partner = $form->getData();

            $em = $this->get('doctrine.orm.entity_manager');
            try {
                $em->persist($partner);
                $em->flush();
            } catch (\Exception $e) {
                $this->get('logger')->error($e, ['exception' => $e]);
                $this->addFlash('error', $this->get('translator')->trans('Unexpected error occurred.'));
            }

            return $this->redirectToRoute('admin.partner');
        }

        return $this->render('admin/partner/new.html.twig', [
            'partner' => $partner,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/edit/{partner}", name="admin.partner.edit")
     *
     * @param Request $request
     * @param Partner $partner
     *
     * @ParamConverter("partner", class="AppBundle:Partner")
     *
     * @return RedirectResponse|Response
     */
    public function editAction(Request $request, Partner $partner)
    {
        $deleteForm = $this->createDeleteForm($partner);
        $editForm = $this->createForm('AppBundle\Form\PartnerType', $partner);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            try {

                $this->getDoctrine()->getManager()->flush();
            } catch (\Exception $e) {
                $this->get('logger')->error($e, ['exception' => $e]);
                $this->addFlash('error', $this->get('translator')->trans('Unexpected error occurred.'));
            }

            return $this->redirectToRoute('admin.partner');
        }
        return $this->render('admin/partner/edit.html.twig', [
            'partner' => $partner,
            'edit_form' => $editForm->createView()
        ]);
    }


    /**
     * @Route("/delete/{partner}", name="admin.partner.delete")
     *
     * @param Request $request
     * @param Partner $partner
     *
     * @ParamConverter("partner", class="AppBundle:Partner")
     *
     * @return RedirectResponse
     */
    public function deleteAction(Request $request, Partner $partner)
    {
        $form = $this->createDeleteForm($partner);
        $form->handleRequest($request);

        $em = $this->getDoctrine()->getManager();

        try {
            $em->remove($partner);
            $em->flush();
        } catch (\Exception $e) {
            $this->get('logger')->error($e, ['exception' => $e]);
            $this->addFlash('error', $this->get('translator')->trans('Unexpected error occurred.'));

            return $this->redirectToRoute('admin.partner');
        }

        return $this->redirectToRoute('admin.partner');
    }

    /**
     * Creates a form to delete a page entity.
     *
     * @param Partner $partner
     *
     * @return \Symfony\Component\Form\FormInterface
     */
    private function createDeleteForm(Partner $partner)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin.partner.delete', [
                'partner' => $partner->getId()
            ]))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }

    /**
     * @Rest\Get("/activated", name="api.partner.activated")
     * @param Request $request
     * @return JsonResponse
     */
    public function activatedAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $partner = $em->getRepository(Partner::class)->find($request->get('id'));

        if ($partner->getisActive()) {
            $partner->setIsActive(false);
        } else {
            $partner->setIsActive(true);
        }

        try {
            $em->persist($partner);
            $em->flush();
        } catch (\Exception $e) {
            $this->get('logger')->error($e, ['exception' => $e]);
            $this->addFlash('error', $this->get('translator')->trans('Unexpected error occurred.'));
            return new JsonResponse(['count'=>'Error']);
        }

        return new JsonResponse(['count'=>'Ok']);
    }


}
