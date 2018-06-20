<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Entity\Partner;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

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
     * @Route("/edit/{city}", name="admin.city.edit")
     *
     * @param Request $request
     * @param City $city
     *
     * @ParamConverter("city", class="AppBundle:City")
     *
     * @return RedirectResponse|Response
     */
    public function editAction(Request $request, City $city)
    {
        $deleteForm = $this->createDeleteForm($city);
        $editForm = $this->createForm('AppBundle\Form\CityType', $city);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            try {
                $city->setNameTranslate();
                $this->getDoctrine()->getManager()->flush();
            } catch (\Exception $e) {
                $this->get('logger')->error($e, ['exception' => $e]);
                $this->addFlash('error', $this->get('translator')->trans('Unexpected error occurred.'));
            }

            return $this->redirectToRoute('admin.city');
        }
        return $this->render('admin/city/edit.html.twig', [
            'city' => $city,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ]);
    }


    /**
     * @Route("/delete/{city}", name="admin.city.delete")
     *
     * @param Request $request
     * @param City $city
     *
     * @ParamConverter("city", class="AppBundle:City")
     *
     * @return RedirectResponse
     */
    public function deleteAction(Request $request, City $city)
    {
        $form = $this->createDeleteForm($city);
        $form->handleRequest($request);

        $em = $this->getDoctrine()->getManager();

        try {
            $em->remove($city);
            $em->flush();
        } catch (\Exception $e) {
            $this->get('logger')->error($e, ['exception' => $e]);
            $this->addFlash('error', $this->get('translator')->trans('Unexpected error occurred.'));

            return $this->redirectToRoute('admin.city', [
                'errorMessage' => 'Данный город имеет зависимости в других таблицах.'
            ]);
        }

        return $this->redirectToRoute('admin.city');
    }

    /**
     * Creates a form to delete a page entity.
     *
     * @param City $city
     *
     * @return \Symfony\Component\Form\FormInterface
     */
    private function createDeleteForm(City $city)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin.city.delete', [
                'city' => $city->getId()
            ]))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }

}
