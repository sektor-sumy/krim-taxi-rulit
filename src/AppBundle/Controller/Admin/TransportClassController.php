<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Entity\City;
use AppBundle\Entity\TransportClass;
use AppBundle\Form\TransportClassType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
/**
 * Class CityController
 * @Route("/transport-class")
 */
class TransportClassController extends Controller
{
    /**
     * @Route("/", name="admin.transport-class")
     */
    public function indexAction(Request $request)
    {
        $transportClasses = $this->getDoctrine()->getRepository(TransportClass::class)->findAll();

        return $this->render('admin/transport-class/list.html.twig', [
            'transportClasses' => $transportClasses,
        ]);
    }


    /**
     * @Route("/new", name="admin.transport-class.new")
     *
     * @param Request $request
     *
     * @return RedirectResponse|Response
     */
    public function newAction(Request $request)
    {
        $transportClass = new TransportClass();
        $form = $this->createForm('AppBundle\Form\TransportClassType', $transportClass);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $transportClass = $form->getData();
            try {
                $transportClass->setNameTranslate();
                $em->persist($transportClass);
                $em->flush();
            } catch (\Exception $e) {
                $this->get('logger')->error($e, ['exception' => $e]);
                $this->addFlash('error', $this->get('translator')->trans('Unexpected error occurred.'));
            }

            return $this->redirectToRoute('admin.transport-class');
        }

        return $this->render('admin/transport-class/new.html.twig', [
            'transport-class' => $transportClass,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/edit/{transportClass}", name="admin.transport-class.edit")
     *
     * @param Request $request
     * @param TransportClass $transportClass
     *
     * @ParamConverter("transportClass", class="AppBundle:TransportClass")
     *
     * @return RedirectResponse|Response
     */
    public function editAction(Request $request, TransportClass $transportClass)
    {
        $deleteForm = $this->createDeleteForm($transportClass);
        $editForm = $this->createForm('AppBundle\Form\TransportClassType', $transportClass);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            try {
                $transportClass->setNameTranslate();
                $this->getDoctrine()->getManager()->flush();
            } catch (\Exception $e) {
                $this->get('logger')->error($e, ['exception' => $e]);
                $this->addFlash('error', $this->get('translator')->trans('Unexpected error occurred.'));
            }

            return $this->redirectToRoute('admin.transport-class');
        }

        return $this->render('admin/transport-class/edit.html.twig', [
            'transportClass' => $transportClass,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ]);
    }


    /**
     * @Route("/delete/{transportClass}", name="admin.transport-class.delete")
     *
     * @param Request $request
     * @param TransportClass $transportClass
     *
     * @ParamConverter("transportClass", class="AppBundle:TransportClass")
     *
     * @return RedirectResponse
     */
    public function deleteAction(Request $request, TransportClass $transportClass)
    {
        $form = $this->createDeleteForm($transportClass);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            try {
                $em->remove($transportClass);
                $em->flush();
            } catch (\Exception $e) {
                $this->get('logger')->error($e, ['exception' => $e]);
                $this->addFlash('error', $this->get('translator')->trans('Unexpected error occurred.'));
            }
        }

        return $this->redirectToRoute('admin.transport-class');
    }

    /**
     * Creates a form to delete a page entity.
     *
     * @param TransportClass $transportClass
     *
     * @return \Symfony\Component\Form\FormInterface
     */
    private function createDeleteForm(TransportClass $transportClass)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin.transport-class.delete', [
                'transportClass' => $transportClass->getId()
            ]))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }

}
