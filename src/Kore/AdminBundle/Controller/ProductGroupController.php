<?php

namespace Kore\AdminBundle\Controller;

use Kore\AdminBundle\Entity\ProductGroup;
use Kore\AdminBundle\Form\ProductGroupType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Productgroup controller.
 *
 */
class ProductGroupController extends Controller
{

    /**
     * Lists all ProductGroup entities.
     *
     */
    public function indexAction(Request $request)
    {
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $productGroups = $em->getRepository('KoreAdminBundle:ProductGroup')->findBy(array(), array($sort => $direction));
        else $productGroups = $em->getRepository('KoreAdminBundle:ProductGroup')->findAll();
        $paginator = $this->get('knp_paginator');
        $productGroups = $paginator->paginate($productGroups, $request->query->getInt('page', 1), 100);

        $deleteForms = array();
        foreach($productGroups as $key => $productGroup) {
            $deleteForms[] = $this->createDeleteForm($productGroup)->createView();
        }

        return $this->render('KoreAdminBundle:ProductGroup:index.html.twig', array(
            'productGroups' => $productGroups,
            'direction' => $direction,
            'sort' => $sort,
            'deleteForms' => $deleteForms,
        ));
    }

    /**
     * Creates a new ProductGroup entity.
     *
     */
    public function newAction(Request $request)
    {
        $productGroup = new ProductGroup();
        $newForm = $this->createNewForm($productGroup);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted()) {
            if($newForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($productGroup);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'productGroup.new.flash' );
                return $this->redirect($this->generateUrl('admin_productgroup_index'));
            }
        }

        return $this->render('KoreAdminBundle:ProductGroup:new.html.twig', array(
            'newForm' => $newForm->createView(),
        ));
    }

    /**
     * Creates a form to create a new ProductGroup entity.
     *
     * @param ProductGroup $productGroup The ProductGroup entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createNewForm(ProductGroup $productGroup)
    {
        return $this->createForm(new ProductGroupType(), $productGroup, array(
            'action' => $this->generateUrl('admin_productgroup_new'),
        ));
    }

    /**
     * Finds and displays a ProductGroup entity.
     *
     */
    public function showAction(ProductGroup $productGroup)
    {
        $editForm = $this->createEditForm($productGroup);
        $deleteForm = $this->createDeleteForm($productGroup);

        return $this->render('KoreAdminBundle:ProductGroup:show.html.twig', array(
            'productGroup' => $productGroup,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing ProductGroup entity.
     *
     */
    public function editAction(Request $request, ProductGroup $productGroup)
    {
        $editForm = $this->createEditForm($productGroup);
        $deleteForm = $this->createDeleteForm($productGroup);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()) {
            if($editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($productGroup);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'productGroup.edit.flash' );
                return $this->redirect($this->generateUrl('admin_productgroup_index'));
            }
        }

        return $this->render('KoreAdminBundle:ProductGroup:edit.html.twig', array(
            'productGroup' => $productGroup,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a ProductGroup entity.
     *
     * @param ProductGroup $productGroup The ProductGroup entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(ProductGroup $productGroup)
    {
        return $this->createForm(new ProductGroupType(), $productGroup, array(
            'action' => $this->generateUrl('admin_productgroup_edit', array('id' => $productGroup->getId())),
        ));
    }

    /**
     * Deletes a ProductGroup entity.
     *
     */
    public function deleteAction(Request $request, ProductGroup $productGroup)
    {
        $deleteForm = $this->createDeleteForm($productGroup);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($productGroup);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'productGroup.delete.flash' );
        }

        return $this->redirect($this->generateUrl('admin_productgroup_index'));
    }

    /**
     * Creates a form to delete a ProductGroup entity.
     *
     * @param ProductGroup $productGroup The ProductGroup entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ProductGroup $productGroup)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_productgroup_delete', array('id' => $productGroup->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
