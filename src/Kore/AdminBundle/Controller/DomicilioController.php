<?php

namespace Kore\AdminBundle\Controller;

use Kore\AdminBundle\Entity\Domicilio;
use Kore\AdminBundle\Form\DomicilioType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Domicilio controller.
 *
 */
class DomicilioController extends Controller
{

    /**
     * Lists all Domicilio entities.
     *
     */
    public function indexAction(Request $request)
    {
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $domicilios = $em->getRepository('KoreAdminBundle:Domicilio')->findBy(array(), array($sort => $direction));
        else $domicilios = $em->getRepository('KoreAdminBundle:Domicilio')->findAll();
        $paginator = $this->get('knp_paginator');
        $domicilios = $paginator->paginate($domicilios, $request->query->getInt('page', 1), 100);

        $deleteForms = array();
        foreach($domicilios as $key => $domicilio) {
            $deleteForms[] = $this->createDeleteForm($domicilio)->createView();
        }

        return $this->render('KoreAdminBundle:Domicilio:index.html.twig', array(
            'domicilios' => $domicilios,
            'direction' => $direction,
            'sort' => $sort,
            'deleteForms' => $deleteForms,
        ));
    }

    /**
     * Creates a new Domicilio entity.
     *
     */
    public function newAction(Request $request)
    {
        $domicilio = new Domicilio();
        $newForm = $this->createNewForm($domicilio);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted()) {
            if($newForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($domicilio);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'domicilio.new.flash' );
                return $this->redirect($this->generateUrl('admin_domicilio_index'));
            }
        }

        return $this->render('KoreAdminBundle:Domicilio:new.html.twig', array(
            'newForm' => $newForm->createView(),
        ));
    }

    /**
     * Creates a form to create a new Domicilio entity.
     *
     * @param Domicilio $domicilio The Domicilio entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createNewForm(Domicilio $domicilio)
    {
        return $this->createForm(new DomicilioType(), $domicilio, array(
            'action' => $this->generateUrl('admin_domicilio_new'),
        ));
    }

    /**
     * Finds and displays a Domicilio entity.
     *
     */
    public function showAction(Domicilio $domicilio)
    {
        $editForm = $this->createEditForm($domicilio);
        $deleteForm = $this->createDeleteForm($domicilio);

        return $this->render('KoreAdminBundle:Domicilio:show.html.twig', array(
            'domicilio' => $domicilio,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Domicilio entity.
     *
     */
    public function editAction(Request $request, Domicilio $domicilio)
    {
        $editForm = $this->createEditForm($domicilio);
        $deleteForm = $this->createDeleteForm($domicilio);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()) {
            if($editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($domicilio);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'domicilio.edit.flash' );
                return $this->redirect($this->generateUrl('admin_domicilio_index'));
            }
        }

        return $this->render('KoreAdminBundle:Domicilio:edit.html.twig', array(
            'domicilio' => $domicilio,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a Domicilio entity.
     *
     * @param Domicilio $domicilio The Domicilio entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Domicilio $domicilio)
    {
        return $this->createForm(new DomicilioType(), $domicilio, array(
            'action' => $this->generateUrl('admin_domicilio_edit', array('id' => $domicilio->getId())),
        ));
    }

    /**
     * Deletes a Domicilio entity.
     *
     */
    public function deleteAction(Request $request, Domicilio $domicilio)
    {
        $deleteForm = $this->createDeleteForm($domicilio);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($domicilio);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'domicilio.delete.flash' );
        }

        return $this->redirect($this->generateUrl('admin_domicilio_index'));
    }

    /**
     * Creates a form to delete a Domicilio entity.
     *
     * @param Domicilio $domicilio The Domicilio entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Domicilio $domicilio)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_domicilio_delete', array('id' => $domicilio->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
