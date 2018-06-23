<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Entity\SettingsSite;
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
 * Class SettingsSiteController
 * @Route("/settings")
 */
class SettingsSiteController extends Controller
{
    /**
     * @Route("/", name="admin.settings")
     */
    public function indexAction(Request $request)
    {
        $settings = $this->getDoctrine()->getRepository(SettingsSite::class)->findAll();

        return $this->render('admin/settings/list.html.twig', [
            'settings' => $settings
        ]);
    }


    /**
     * Creates a new settings entity.
     *
     * @Route("/new", name="admin.settings.new")
     *
     * @param Request $request
     *
     * @return RedirectResponse|Response
     */
    public function newAction(Request $request)
    {
        $settings = new SettingsSite();
        $form = $this->createForm('AppBundle\Form\SettingsSiteType', $settings);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $settings = $form->getData();

            $em = $this->get('doctrine.orm.entity_manager');
            try {
                $em->persist($settings);
                $em->flush();
            } catch (\Exception $e) {
                $this->get('logger')->error($e, ['exception' => $e]);
                $this->addFlash('error', $this->get('translator')->trans('Unexpected error occurred.'));
            }

            return $this->redirectToRoute('admin.settings');
        }

        return $this->render('admin/settings/new.html.twig', [
            'settings' => $settings,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/edit/{setting}", name="admin.settings.edit")
     *
     * @param Request $request
     * @param SettingsSite $setting
     *
     * @ParamConverter("setting", class="AppBundle:SettingsSite")
     *
     * @return RedirectResponse|Response
     */
    public function editAction(Request $request, SettingsSite $setting)
    {
        $deleteForm = $this->createDeleteForm($setting);
        $editForm = $this->createForm('AppBundle\Form\SettingsSiteType', $setting);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            try {
                $this->getDoctrine()->getManager()->flush();
            } catch (\Exception $e) {
                $this->get('logger')->error($e, ['exception' => $e]);
                $this->addFlash('error', $this->get('translator')->trans('Unexpected error occurred.'));
            }

            return $this->redirectToRoute('admin.city');
        }
        return $this->render('admin/settings/edit.html.twig', [
            'setting' => $setting,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ]);
    }


    /**
     * @Route("/delete/{setting}", name="admin.settings.delete")
     *
     * @param Request $request
     * @param SettingsSite $setting
     *
     * @ParamConverter("setting", class="AppBundle:SettingsSite")
     *
     * @return RedirectResponse
     */
    public function deleteAction(Request $request, SettingsSite $setting)
    {
        $form = $this->createDeleteForm($setting);
        $form->handleRequest($request);

        $em = $this->getDoctrine()->getManager();

        try {
            $em->remove($setting);
            $em->flush();
        } catch (\Exception $e) {
            $this->get('logger')->error($e, ['exception' => $e]);
            $this->addFlash('error', $this->get('translator')->trans('Unexpected error occurred.'));

            return $this->redirectToRoute('admin.settings');
        }

        return $this->redirectToRoute('admin.settings');
    }

    /**
     * Creates a form to delete a page entity.
     *
     * @param SettingsSite $setting
     *
     * @return \Symfony\Component\Form\FormInterface
     */
    private function createDeleteForm(SettingsSite $setting)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin.settings.delete', [
                'setting' => $setting->getId()
            ]))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }



    /**
     * @Rest\Get("/activated", name="api.settings.activated")
     * @param Request $request
     * @return JsonResponse
     */
    public function activatedAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $em->getRepository(SettingsSite::class)->allNotActivated();
        $em->flush();


        $setting = $em->getRepository(SettingsSite::class)->find($request->get('id'));
        $setting->setIsActive(true);

        try {
            $em->persist($setting);
            $em->flush();
        } catch (\Exception $e) {
            dump($e); die;
            $this->get('logger')->error($e, ['exception' => $e]);
            $this->addFlash('error', $this->get('translator')->trans('Unexpected error occurred.'));
            return new JsonResponse(['count'=>'Error']);
        }

        return new JsonResponse(['count'=>'Ok']);
    }
}
