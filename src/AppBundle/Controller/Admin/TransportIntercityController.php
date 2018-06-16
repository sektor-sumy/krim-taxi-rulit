<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Entity\City;
use AppBundle\Entity\TransportIntercity;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
/**
 * Class CityController
 * @Route("/transport-intercity")
 */
class TransportIntercityController extends Controller
{
    /**
     * @Route("/", name="admin.transport-intercity")
     */
    public function indexAction(Request $request)
    {
        $transportIntercityes = $this->getDoctrine()->getRepository(TransportIntercity::class)->findAll();

        return $this->render('admin/transport-intercity/list.html.twig', [
            'transportIntercityes' => $transportIntercityes,
        ]);
    }


    /**
     * @Route("/new", name="admin.transport-intercity.new")
     *
     * @param Request $request
     *
     * @return RedirectResponse|Response
     */
    public function newAction(Request $request)
    {
        $transportIntercity = new TransportIntercity();
        $form = $this->createForm('AppBundle\Form\TransportIntercityType', $transportIntercity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $city = $form->getData();

            $em = $this->get('doctrine.orm.entity_manager');
            try {
                $em->persist($transportIntercity);
                $em->flush();
            } catch (\Exception $e) {
                $this->get('logger')->error($e, ['exception' => $e]);
                $this->addFlash('error', $this->get('translator')->trans('Unexpected error occurred.'));
            }

            return $this->redirectToRoute('admin.transport-intercity');
        }

        return $this->render('admin/transport-intercity/new.html.twig', [
            'transportIntercity' => $transportIntercity,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/edit/{transportIntercity}", name="admin.transport-intercity.edit")
     *
     * @param Request $request
     * @param TransportIntercity $transportIntercity
     *
     * @ParamConverter("transportIntercity", class="AppBundle:TransportIntercity")
     *
     * @return RedirectResponse|Response
     */
    public function editAction(Request $request, TransportIntercity $transportIntercity)
    {
        $deleteForm = $this->createDeleteForm($transportIntercity);
        $editForm = $this->createForm('AppBundle\Form\TransportIntercityType', $transportIntercity);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            try {
                $this->getDoctrine()->getManager()->flush();
            } catch (\Exception $e) {
                $this->get('logger')->error($e, ['exception' => $e]);
                $this->addFlash('error', $this->get('translator')->trans('Unexpected error occurred.'));
            }

            return $this->redirectToRoute('admin.transport-intercity');
        }

        return $this->render('admin/transport-intercity/edit.html.twig', [
            'transportIntercity' => $transportIntercity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ]);
    }


    /**
     * @Route("/delete/{transportIntercity}", name="admin.transport-intercity.delete")
     *
     * @param Request $request
     * @param TransportIntercity $transportIntercity
     *
     * @ParamConverter("transportIntercity", class="AppBundle:TransportIntercity")
     *
     * @return RedirectResponse
     */
    public function deleteAction(Request $request, TransportIntercity $transportIntercity)
    {
        $form = $this->createDeleteForm($transportIntercity);
        $form->handleRequest($request);

        $em = $this->getDoctrine()->getManager();

        try {
            $em->remove($transportIntercity);
            $em->flush();
        } catch (\Exception $e) {
            $this->get('logger')->error($e, ['exception' => $e]);
            $this->addFlash('error', $this->get('translator')->trans('Unexpected error occurred.'));
        }

        return $this->redirectToRoute('admin.transport-intercity');
    }

    /**
     * Creates a form to delete a page entity.
     *
     * @param TransportIntercity $transportIntercity
     *
     * @return \Symfony\Component\Form\FormInterface
     */
    private function createDeleteForm(TransportIntercity $transportIntercity)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin.transport-intercity.delete', [
                'transportIntercity' => $transportIntercity->getId()
            ]))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }

}
