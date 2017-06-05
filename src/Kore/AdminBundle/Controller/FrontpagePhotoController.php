<?php

namespace Kore\AdminBundle\Controller;

use Kore\AdminBundle\Entity\FrontpagePhoto;
use Kore\AdminBundle\Form\FrontpagePhotoType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Frontpagephoto controller.
 *
 */
class FrontpagePhotoController extends Controller
{

    /**
     * Lists all FrontpagePhoto entities.
     *
     */
    public function indexAction(Request $request)
    {
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $frontpagePhotos = $em->getRepository('KoreAdminBundle:FrontpagePhoto')->findBy(array(), array($sort => $direction));
        else $frontpagePhotos = $em->getRepository('KoreAdminBundle:FrontpagePhoto')->findAll();
        $paginator = $this->get('knp_paginator');
        $frontpagePhotos = $paginator->paginate($frontpagePhotos, $request->query->getInt('page', 1), 100);

        $deleteForms = array();
        foreach($frontpagePhotos as $key => $frontpagePhoto) {
            $deleteForms[] = $this->createDeleteForm($frontpagePhoto)->createView();
        }

        return $this->render('KoreAdminBundle:FrontpagePhoto:index.html.twig', array(
            'frontpagePhotos' => $frontpagePhotos,
            'direction' => $direction,
            'sort' => $sort,
            'deleteForms' => $deleteForms,
        ));
    }

    /**
     * Creates a new FrontpagePhoto entity.
     *
     */
    public function newAction(Request $request)
    {
        $frontpagePhoto = new FrontpagePhoto();
        $newForm = $this->createNewForm($frontpagePhoto);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted()) {
            if($newForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($frontpagePhoto);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'frontpagePhoto.new.flash' );
                return $this->redirect($this->generateUrl('admin_frontpagephoto_index'));
            }
        }

        return $this->render('KoreAdminBundle:FrontpagePhoto:new.html.twig', array(
            'newForm' => $newForm->createView(),
        ));
    }

    /**
     * Creates a form to create a new FrontpagePhoto entity.
     *
     * @param FrontpagePhoto $frontpagePhoto The FrontpagePhoto entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createNewForm(FrontpagePhoto $frontpagePhoto)
    {
        return $this->createForm(new FrontpagePhotoType(), $frontpagePhoto, array(
            'action' => $this->generateUrl('admin_frontpagephoto_new'),
        ));
    }

    /**
     * Finds and displays a FrontpagePhoto entity.
     *
     */
    public function showAction(FrontpagePhoto $frontpagePhoto)
    {
        $editForm = $this->createEditForm($frontpagePhoto);
        $deleteForm = $this->createDeleteForm($frontpagePhoto);

        return $this->render('KoreAdminBundle:FrontpagePhoto:show.html.twig', array(
            'frontpagePhoto' => $frontpagePhoto,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing FrontpagePhoto entity.
     *
     */
    public function editAction(Request $request, FrontpagePhoto $frontpagePhoto)
    {
        $editForm = $this->createEditForm($frontpagePhoto);
        $deleteForm = $this->createDeleteForm($frontpagePhoto);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()) {
            if($editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($frontpagePhoto);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'frontpagePhoto.edit.flash' );
                return $this->redirect($this->generateUrl('admin_frontpagephoto_index'));
            }
        }

        return $this->render('KoreAdminBundle:FrontpagePhoto:edit.html.twig', array(
            'frontpagePhoto' => $frontpagePhoto,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a FrontpagePhoto entity.
     *
     * @param FrontpagePhoto $frontpagePhoto The FrontpagePhoto entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(FrontpagePhoto $frontpagePhoto)
    {
        return $this->createForm(new FrontpagePhotoType(), $frontpagePhoto, array(
            'action' => $this->generateUrl('admin_frontpagephoto_edit', array('id' => $frontpagePhoto->getId())),
        ));
    }

    /**
     * Deletes a FrontpagePhoto entity.
     *
     */
    public function deleteAction(Request $request, FrontpagePhoto $frontpagePhoto)
    {
        $deleteForm = $this->createDeleteForm($frontpagePhoto);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($frontpagePhoto);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'frontpagePhoto.delete.flash' );
        }

        return $this->redirect($this->generateUrl('admin_frontpagephoto_index'));
    }

    /**
     * Creates a form to delete a FrontpagePhoto entity.
     *
     * @param FrontpagePhoto $frontpagePhoto The FrontpagePhoto entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(FrontpagePhoto $frontpagePhoto)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_frontpagephoto_delete', array('id' => $frontpagePhoto->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
