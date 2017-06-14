<?php

namespace Kore\AdminBundle\Controller;

use Kore\AdminBundle\Entity\Brand;
use Kore\AdminBundle\Form\BrandType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Brand controller.
 *
 */
class BrandController extends Controller
{

    /**
     * Lists all Brand entities.
     *
     */
    public function indexAction(Request $request)
    {
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $brands = $em->getRepository('KoreAdminBundle:Brand')->findBy(array(), array($sort => $direction));
        else $brands = $em->getRepository('KoreAdminBundle:Brand')->findAll();
        $paginator = $this->get('knp_paginator');
        $brands = $paginator->paginate($brands, $request->query->getInt('page', 1), 100);

        $deleteForms = array();
        foreach($brands as $key => $brand) {
            $deleteForms[] = $this->createDeleteForm($brand)->createView();
        }

        return $this->render('KoreAdminBundle:Brand:index.html.twig', array(
            'brands' => $brands,
            'direction' => $direction,
            'sort' => $sort,
            'deleteForms' => $deleteForms,
        ));
    }

    /**
     * Creates a new Brand entity.
     *
     */
    public function newAction(Request $request)
    {
        $brand = new Brand();
        $newForm = $this->createNewForm($brand);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted()) {
            if($newForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($brand);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'brand.new.flash' );
                return $this->redirect($this->generateUrl('admin_brand_index'));
            }
        }

        return $this->render('KoreAdminBundle:Brand:new.html.twig', array(
            'newForm' => $newForm->createView(),
        ));
    }

    /**
     * Creates a form to create a new Brand entity.
     *
     * @param Brand $brand The Brand entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createNewForm(Brand $brand)
    {
        return $this->createForm(new BrandType(), $brand, array(
            'action' => $this->generateUrl('admin_brand_new'),
        ));
    }

    /**
     * Finds and displays a Brand entity.
     *
     */
    public function showAction(Brand $brand)
    {
        $editForm = $this->createEditForm($brand);
        $deleteForm = $this->createDeleteForm($brand);

        return $this->render('KoreAdminBundle:Brand:show.html.twig', array(
            'brand' => $brand,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Brand entity.
     *
     */
    public function editAction(Request $request, Brand $brand)
    {
        $editForm = $this->createEditForm($brand);
        $deleteForm = $this->createDeleteForm($brand);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()) {
            if($editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($brand);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'brand.edit.flash' );
                return $this->redirect($this->generateUrl('admin_brand_index'));
            }
        }

        return $this->render('KoreAdminBundle:Brand:edit.html.twig', array(
            'brand' => $brand,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a Brand entity.
     *
     * @param Brand $brand The Brand entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Brand $brand)
    {
        return $this->createForm(new BrandType(), $brand, array(
            'action' => $this->generateUrl('admin_brand_edit', array('id' => $brand->getId())),
        ));
    }

    /**
     * Deletes a Brand entity.
     *
     */
    public function deleteAction(Request $request, Brand $brand)
    {
        $deleteForm = $this->createDeleteForm($brand);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($brand);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'brand.delete.flash' );
        }

        return $this->redirect($this->generateUrl('admin_brand_index'));
    }

    /**
     * Creates a form to delete a Brand entity.
     *
     * @param Brand $brand The Brand entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Brand $brand)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_brand_delete', array('id' => $brand->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
