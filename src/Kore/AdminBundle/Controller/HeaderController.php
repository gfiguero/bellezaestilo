<?php

namespace Kore\AdminBundle\Controller;

use Kore\AdminBundle\Entity\Header;
use Kore\AdminBundle\Form\HeaderType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Header controller.
 *
 */
class HeaderController extends Controller
{

    /**
     * Lists all Header entities.
     *
     */
    public function indexAction(Request $request)
    {
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $headers = $em->getRepository('KoreAdminBundle:Header')->findBy(array(), array($sort => $direction));
        else $headers = $em->getRepository('KoreAdminBundle:Header')->findAll();
        $paginator = $this->get('knp_paginator');
        $headers = $paginator->paginate($headers, $request->query->getInt('page', 1), 100);

        $deleteForms = array();
        foreach($headers as $key => $header) {
            $deleteForms[] = $this->createDeleteForm($header)->createView();
        }

        return $this->render('KoreAdminBundle:Header:index.html.twig', array(
            'headers' => $headers,
            'direction' => $direction,
            'sort' => $sort,
            'deleteForms' => $deleteForms,
        ));
    }

    /**
     * Creates a new Header entity.
     *
     */
    public function newAction(Request $request)
    {
        $header = new Header();
        $newForm = $this->createNewForm($header);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted()) {
            if($newForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($header);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'header.new.flash' );
                return $this->redirect($this->generateUrl('admin_header_index'));
            }
        }

        return $this->render('KoreAdminBundle:Header:new.html.twig', array(
            'newForm' => $newForm->createView(),
        ));
    }

    /**
     * Creates a form to create a new Header entity.
     *
     * @param Header $header The Header entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createNewForm(Header $header)
    {
        return $this->createForm(new HeaderType(), $header, array(
            'action' => $this->generateUrl('admin_header_new'),
        ));
    }

    /**
     * Finds and displays a Header entity.
     *
     */
    public function showAction(Header $header)
    {
        $editForm = $this->createEditForm($header);
        $deleteForm = $this->createDeleteForm($header);

        return $this->render('KoreAdminBundle:Header:show.html.twig', array(
            'header' => $header,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Header entity.
     *
     */
    public function editAction(Request $request, Header $header)
    {
        $editForm = $this->createEditForm($header);
        $deleteForm = $this->createDeleteForm($header);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()) {
            if($editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($header);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'header.edit.flash' );
                return $this->redirect($this->generateUrl('admin_header_index'));
            }
        }

        return $this->render('KoreAdminBundle:Header:edit.html.twig', array(
            'header' => $header,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a Header entity.
     *
     * @param Header $header The Header entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Header $header)
    {
        return $this->createForm(new HeaderType(), $header, array(
            'action' => $this->generateUrl('admin_header_edit', array('id' => $header->getId())),
        ));
    }

    /**
     * Deletes a Header entity.
     *
     */
    public function deleteAction(Request $request, Header $header)
    {
        $deleteForm = $this->createDeleteForm($header);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($header);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'header.delete.flash' );
        }

        return $this->redirect($this->generateUrl('admin_header_index'));
    }

    /**
     * Creates a form to delete a Header entity.
     *
     * @param Header $header The Header entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Header $header)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_header_delete', array('id' => $header->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
