<?php

namespace Kore\AdminBundle\Controller;

use Kore\AdminBundle\Entity\Encuestador;
use Kore\AdminBundle\Form\EncuestadorType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Encuestador controller.
 *
 */
class EncuestadorController extends Controller
{

    /**
     * Lists all Encuestador entities.
     *
     */
    public function indexAction(Request $request)
    {
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $encuestadors = $em->getRepository('KoreAdminBundle:Encuestador')->findBy(array(), array($sort => $direction));
        else $encuestadors = $em->getRepository('KoreAdminBundle:Encuestador')->findAll();
        $paginator = $this->get('knp_paginator');
        $encuestadors = $paginator->paginate($encuestadors, $request->query->getInt('page', 1), 100);

        $deleteForms = array();
        foreach($encuestadors as $key => $encuestador) {
            $deleteForms[] = $this->createDeleteForm($encuestador)->createView();
        }

        return $this->render('KoreAdminBundle:Encuestador:index.html.twig', array(
            'encuestadors' => $encuestadors,
            'direction' => $direction,
            'sort' => $sort,
            'deleteForms' => $deleteForms,
        ));
    }

    /**
     * Creates a new Encuestador entity.
     *
     */
    public function newAction(Request $request)
    {
        $encuestador = new Encuestador();
        $newForm = $this->createNewForm($encuestador);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted()) {
            if($newForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($encuestador);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'encuestador.new.flash' );
                return $this->redirect($this->generateUrl('admin_encuestador_index'));
            }
        }

        return $this->render('KoreAdminBundle:Encuestador:new.html.twig', array(
            'newForm' => $newForm->createView(),
        ));
    }

    /**
     * Creates a form to create a new Encuestador entity.
     *
     * @param Encuestador $encuestador The Encuestador entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createNewForm(Encuestador $encuestador)
    {
        return $this->createForm(new EncuestadorType(), $encuestador, array(
            'action' => $this->generateUrl('admin_encuestador_new'),
        ));
    }

    /**
     * Finds and displays a Encuestador entity.
     *
     */
    public function showAction(Encuestador $encuestador)
    {
        $editForm = $this->createEditForm($encuestador);
        $deleteForm = $this->createDeleteForm($encuestador);

        return $this->render('KoreAdminBundle:Encuestador:show.html.twig', array(
            'encuestador' => $encuestador,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Encuestador entity.
     *
     */
    public function editAction(Request $request, Encuestador $encuestador)
    {
        $editForm = $this->createEditForm($encuestador);
        $deleteForm = $this->createDeleteForm($encuestador);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()) {
            if($editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($encuestador);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'encuestador.edit.flash' );
                return $this->redirect($this->generateUrl('admin_encuestador_index'));
            }
        }

        return $this->render('KoreAdminBundle:Encuestador:edit.html.twig', array(
            'encuestador' => $encuestador,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a Encuestador entity.
     *
     * @param Encuestador $encuestador The Encuestador entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Encuestador $encuestador)
    {
        return $this->createForm(new EncuestadorType(), $encuestador, array(
            'action' => $this->generateUrl('admin_encuestador_edit', array('id' => $encuestador->getId())),
        ));
    }

    /**
     * Deletes a Encuestador entity.
     *
     */
    public function deleteAction(Request $request, Encuestador $encuestador)
    {
        $deleteForm = $this->createDeleteForm($encuestador);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($encuestador);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'encuestador.delete.flash' );
        }

        return $this->redirect($this->generateUrl('admin_encuestador_index'));
    }

    /**
     * Creates a form to delete a Encuestador entity.
     *
     * @param Encuestador $encuestador The Encuestador entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Encuestador $encuestador)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_encuestador_delete', array('id' => $encuestador->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
