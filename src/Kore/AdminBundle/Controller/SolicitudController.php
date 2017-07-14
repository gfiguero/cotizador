<?php

namespace Kore\AdminBundle\Controller;

use Kore\AdminBundle\Entity\Solicitud;
use Kore\AdminBundle\Form\SolicitudType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Solicitud controller.
 *
 */
class SolicitudController extends Controller
{

    /**
     * Lists all Solicitud entities.
     *
     */
    public function indexAction(Request $request)
    {
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $solicituds = $em->getRepository('KoreAdminBundle:Solicitud')->findBy(array(), array($sort => $direction));
        else $solicituds = $em->getRepository('KoreAdminBundle:Solicitud')->findAll();
        $paginator = $this->get('knp_paginator');
        $solicituds = $paginator->paginate($solicituds, $request->query->getInt('page', 1), 100);

        $deleteForms = array();
        foreach($solicituds as $key => $solicitud) {
            $deleteForms[] = $this->createDeleteForm($solicitud)->createView();
        }

        return $this->render('KoreAdminBundle:Solicitud:index.html.twig', array(
            'solicituds' => $solicituds,
            'direction' => $direction,
            'sort' => $sort,
            'deleteForms' => $deleteForms,
        ));
    }

    /**
     * Creates a new Solicitud entity.
     *
     */
    public function newAction(Request $request)
    {
        $solicitud = new Solicitud();
        $newForm = $this->createNewForm($solicitud);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted()) {
            if($newForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($solicitud);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'solicitud.new.flash' );
                return $this->redirect($this->generateUrl('admin_solicitud_index'));
            }
        }

        return $this->render('KoreAdminBundle:Solicitud:new.html.twig', array(
            'newForm' => $newForm->createView(),
        ));
    }

    /**
     * Creates a form to create a new Solicitud entity.
     *
     * @param Solicitud $solicitud The Solicitud entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createNewForm(Solicitud $solicitud)
    {
        return $this->createForm(new SolicitudType(), $solicitud, array(
            'action' => $this->generateUrl('admin_solicitud_new'),
        ));
    }

    /**
     * Finds and displays a Solicitud entity.
     *
     */
    public function showAction(Solicitud $solicitud)
    {
        $editForm = $this->createEditForm($solicitud);
        $deleteForm = $this->createDeleteForm($solicitud);

        return $this->render('KoreAdminBundle:Solicitud:show.html.twig', array(
            'solicitud' => $solicitud,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Solicitud entity.
     *
     */
    public function editAction(Request $request, Solicitud $solicitud)
    {
        $editForm = $this->createEditForm($solicitud);
        $deleteForm = $this->createDeleteForm($solicitud);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()) {
            if($editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($solicitud);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'solicitud.edit.flash' );
                return $this->redirect($this->generateUrl('admin_solicitud_index'));
            }
        }

        return $this->render('KoreAdminBundle:Solicitud:edit.html.twig', array(
            'solicitud' => $solicitud,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a Solicitud entity.
     *
     * @param Solicitud $solicitud The Solicitud entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Solicitud $solicitud)
    {
        return $this->createForm(new SolicitudType(), $solicitud, array(
            'action' => $this->generateUrl('admin_solicitud_edit', array('id' => $solicitud->getId())),
        ));
    }

    /**
     * Deletes a Solicitud entity.
     *
     */
    public function deleteAction(Request $request, Solicitud $solicitud)
    {
        $deleteForm = $this->createDeleteForm($solicitud);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($solicitud);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'solicitud.delete.flash' );
        }

        return $this->redirect($this->generateUrl('admin_solicitud_index'));
    }

    /**
     * Creates a form to delete a Solicitud entity.
     *
     * @param Solicitud $solicitud The Solicitud entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Solicitud $solicitud)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_solicitud_delete', array('id' => $solicitud->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
