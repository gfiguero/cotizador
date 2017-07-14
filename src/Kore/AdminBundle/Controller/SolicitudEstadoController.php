<?php

namespace Kore\AdminBundle\Controller;

use Kore\AdminBundle\Entity\SolicitudEstado;
use Kore\AdminBundle\Form\SolicitudEstadoType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Solicitudestado controller.
 *
 */
class SolicitudEstadoController extends Controller
{

    /**
     * Lists all SolicitudEstado entities.
     *
     */
    public function indexAction(Request $request)
    {
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $solicitudEstados = $em->getRepository('KoreAdminBundle:SolicitudEstado')->findBy(array(), array($sort => $direction));
        else $solicitudEstados = $em->getRepository('KoreAdminBundle:SolicitudEstado')->findAll();
        $paginator = $this->get('knp_paginator');
        $solicitudEstados = $paginator->paginate($solicitudEstados, $request->query->getInt('page', 1), 100);

        $deleteForms = array();
        foreach($solicitudEstados as $key => $solicitudEstado) {
            $deleteForms[] = $this->createDeleteForm($solicitudEstado)->createView();
        }

        return $this->render('KoreAdminBundle:SolicitudEstado:index.html.twig', array(
            'solicitudEstados' => $solicitudEstados,
            'direction' => $direction,
            'sort' => $sort,
            'deleteForms' => $deleteForms,
        ));
    }

    /**
     * Creates a new SolicitudEstado entity.
     *
     */
    public function newAction(Request $request)
    {
        $solicitudEstado = new SolicitudEstado();
        $newForm = $this->createNewForm($solicitudEstado);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted()) {
            if($newForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($solicitudEstado);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'solicitudEstado.new.flash' );
                return $this->redirect($this->generateUrl('admin_solicitudestado_index'));
            }
        }

        return $this->render('KoreAdminBundle:SolicitudEstado:new.html.twig', array(
            'newForm' => $newForm->createView(),
        ));
    }

    /**
     * Creates a form to create a new SolicitudEstado entity.
     *
     * @param SolicitudEstado $solicitudEstado The SolicitudEstado entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createNewForm(SolicitudEstado $solicitudEstado)
    {
        return $this->createForm(new SolicitudEstadoType(), $solicitudEstado, array(
            'action' => $this->generateUrl('admin_solicitudestado_new'),
        ));
    }

    /**
     * Finds and displays a SolicitudEstado entity.
     *
     */
    public function showAction(SolicitudEstado $solicitudEstado)
    {
        $editForm = $this->createEditForm($solicitudEstado);
        $deleteForm = $this->createDeleteForm($solicitudEstado);

        return $this->render('KoreAdminBundle:SolicitudEstado:show.html.twig', array(
            'solicitudEstado' => $solicitudEstado,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing SolicitudEstado entity.
     *
     */
    public function editAction(Request $request, SolicitudEstado $solicitudEstado)
    {
        $editForm = $this->createEditForm($solicitudEstado);
        $deleteForm = $this->createDeleteForm($solicitudEstado);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()) {
            if($editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($solicitudEstado);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'solicitudEstado.edit.flash' );
                return $this->redirect($this->generateUrl('admin_solicitudestado_index'));
            }
        }

        return $this->render('KoreAdminBundle:SolicitudEstado:edit.html.twig', array(
            'solicitudEstado' => $solicitudEstado,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a SolicitudEstado entity.
     *
     * @param SolicitudEstado $solicitudEstado The SolicitudEstado entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(SolicitudEstado $solicitudEstado)
    {
        return $this->createForm(new SolicitudEstadoType(), $solicitudEstado, array(
            'action' => $this->generateUrl('admin_solicitudestado_edit', array('id' => $solicitudEstado->getId())),
        ));
    }

    /**
     * Deletes a SolicitudEstado entity.
     *
     */
    public function deleteAction(Request $request, SolicitudEstado $solicitudEstado)
    {
        $deleteForm = $this->createDeleteForm($solicitudEstado);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($solicitudEstado);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'solicitudEstado.delete.flash' );
        }

        return $this->redirect($this->generateUrl('admin_solicitudestado_index'));
    }

    /**
     * Creates a form to delete a SolicitudEstado entity.
     *
     * @param SolicitudEstado $solicitudEstado The SolicitudEstado entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(SolicitudEstado $solicitudEstado)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_solicitudestado_delete', array('id' => $solicitudEstado->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
