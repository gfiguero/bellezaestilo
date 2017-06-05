<?php

namespace Kore\AdminBundle\Controller;

use Kore\AdminBundle\Entity\Frontpage;
use Kore\AdminBundle\Form\FrontpageType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Frontpage controller.
 *
 */
class FrontpageController extends Controller
{

    /**
     * Lists all Frontpage entities.
     *
     */
    public function indexAction(Request $request)
    {
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $frontpages = $em->getRepository('KoreAdminBundle:Frontpage')->findBy(array(), array($sort => $direction));
        else $frontpages = $em->getRepository('KoreAdminBundle:Frontpage')->findAll();
        $paginator = $this->get('knp_paginator');
        $frontpages = $paginator->paginate($frontpages, $request->query->getInt('page', 1), 100);

        $deleteForms = array();
        foreach($frontpages as $key => $frontpage) {
            $deleteForms[] = $this->createDeleteForm($frontpage)->createView();
        }

        return $this->render('KoreAdminBundle:Frontpage:index.html.twig', array(
            'frontpages' => $frontpages,
            'direction' => $direction,
            'sort' => $sort,
            'deleteForms' => $deleteForms,
        ));
    }

    /**
     * Creates a new Frontpage entity.
     *
     */
    public function newAction(Request $request)
    {
        $frontpage = new Frontpage();
        $newForm = $this->createNewForm($frontpage);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted()) {
            if($newForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($frontpage);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'frontpage.new.flash' );
                return $this->redirect($this->generateUrl('admin_frontpage_index'));
            }
        }

        return $this->render('KoreAdminBundle:Frontpage:new.html.twig', array(
            'newForm' => $newForm->createView(),
        ));
    }

    /**
     * Creates a form to create a new Frontpage entity.
     *
     * @param Frontpage $frontpage The Frontpage entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createNewForm(Frontpage $frontpage)
    {
        return $this->createForm(new FrontpageType(), $frontpage, array(
            'action' => $this->generateUrl('admin_frontpage_new'),
        ));
    }

    /**
     * Finds and displays a Frontpage entity.
     *
     */
    public function showAction(Frontpage $frontpage)
    {
        $editForm = $this->createEditForm($frontpage);
        $deleteForm = $this->createDeleteForm($frontpage);

        return $this->render('KoreAdminBundle:Frontpage:show.html.twig', array(
            'frontpage' => $frontpage,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Frontpage entity.
     *
     */
    public function editAction(Request $request, Frontpage $frontpage)
    {
        $editForm = $this->createEditForm($frontpage);
        $deleteForm = $this->createDeleteForm($frontpage);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()) {
            if($editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($frontpage);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'frontpage.edit.flash' );
                return $this->redirect($this->generateUrl('admin_frontpage_index'));
            }
        }

        return $this->render('KoreAdminBundle:Frontpage:edit.html.twig', array(
            'frontpage' => $frontpage,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a Frontpage entity.
     *
     * @param Frontpage $frontpage The Frontpage entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Frontpage $frontpage)
    {
        return $this->createForm(new FrontpageType(), $frontpage, array(
            'action' => $this->generateUrl('admin_frontpage_edit', array('id' => $frontpage->getId())),
        ));
    }

    /**
     * Deletes a Frontpage entity.
     *
     */
    public function deleteAction(Request $request, Frontpage $frontpage)
    {
        $deleteForm = $this->createDeleteForm($frontpage);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($frontpage);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'frontpage.delete.flash' );
        }

        return $this->redirect($this->generateUrl('admin_frontpage_index'));
    }

    /**
     * Creates a form to delete a Frontpage entity.
     *
     * @param Frontpage $frontpage The Frontpage entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Frontpage $frontpage)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_frontpage_delete', array('id' => $frontpage->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
