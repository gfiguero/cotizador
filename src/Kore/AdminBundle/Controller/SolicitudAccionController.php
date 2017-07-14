<?php

namespace Kore\AdminBundle\Controller;

use Kore\AdminBundle\Entity\SolicitudAccion;
use Kore\AdminBundle\Form\SolicitudAccionType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Solicitudaccion controller.
 *
 */
class SolicitudAccionController extends Controller
{

    /**
     * Lists all SolicitudAccion entities.
     *
     */
    public function indexAction(Request $request)
    {
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $solicitudAccions = $em->getRepository('KoreAdminBundle:SolicitudAccion')->findBy(array(), array($sort => $direction));
        else $solicitudAccions = $em->getRepository('KoreAdminBundle:SolicitudAccion')->findAll();
        $paginator = $this->get('knp_paginator');
        $solicitudAccions = $paginator->paginate($solicitudAccions, $request->query->getInt('page', 1), 100);

        $deleteForms = array();
        foreach($solicitudAccions as $key => $solicitudAccion) {
            $deleteForms[] = $this->createDeleteForm($solicitudAccion)->createView();
        }

        return $this->render('KoreAdminBundle:SolicitudAccion:index.html.twig', array(
            'solicitudAccions' => $solicitudAccions,
            'direction' => $direction,
            'sort' => $sort,
            'deleteForms' => $deleteForms,
        ));
    }

    /**
     * Creates a new SolicitudAccion entity.
     *
     */
    public function newAction(Request $request)
    {
        $solicitudAccion = new SolicitudAccion();
        $newForm = $this->createNewForm($solicitudAccion);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted()) {
            if($newForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($solicitudAccion);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'solicitudAccion.new.flash' );
                return $this->redirect($this->generateUrl('admin_solicitudaccion_index'));
            }
        }

        return $this->render('KoreAdminBundle:SolicitudAccion:new.html.twig', array(
            'newForm' => $newForm->createView(),
        ));
    }

    /**
     * Creates a form to create a new SolicitudAccion entity.
     *
     * @param SolicitudAccion $solicitudAccion The SolicitudAccion entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createNewForm(SolicitudAccion $solicitudAccion)
    {
        return $this->createForm(new SolicitudAccionType(), $solicitudAccion, array(
            'action' => $this->generateUrl('admin_solicitudaccion_new'),
        ));
    }

    /**
     * Finds and displays a SolicitudAccion entity.
     *
     */
    public function showAction(SolicitudAccion $solicitudAccion)
    {
        $editForm = $this->createEditForm($solicitudAccion);
        $deleteForm = $this->createDeleteForm($solicitudAccion);

        return $this->render('KoreAdminBundle:SolicitudAccion:show.html.twig', array(
            'solicitudAccion' => $solicitudAccion,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing SolicitudAccion entity.
     *
     */
    public function editAction(Request $request, SolicitudAccion $solicitudAccion)
    {
        $editForm = $this->createEditForm($solicitudAccion);
        $deleteForm = $this->createDeleteForm($solicitudAccion);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()) {
            if($editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($solicitudAccion);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'solicitudAccion.edit.flash' );
                return $this->redirect($this->generateUrl('admin_solicitudaccion_index'));
            }
        }

        return $this->render('KoreAdminBundle:SolicitudAccion:edit.html.twig', array(
            'solicitudAccion' => $solicitudAccion,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a SolicitudAccion entity.
     *
     * @param SolicitudAccion $solicitudAccion The SolicitudAccion entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(SolicitudAccion $solicitudAccion)
    {
        return $this->createForm(new SolicitudAccionType(), $solicitudAccion, array(
            'action' => $this->generateUrl('admin_solicitudaccion_edit', array('id' => $solicitudAccion->getId())),
        ));
    }

    /**
     * Deletes a SolicitudAccion entity.
     *
     */
    public function deleteAction(Request $request, SolicitudAccion $solicitudAccion)
    {
        $deleteForm = $this->createDeleteForm($solicitudAccion);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($solicitudAccion);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'solicitudAccion.delete.flash' );
        }

        return $this->redirect($this->generateUrl('admin_solicitudaccion_index'));
    }

    /**
     * Creates a form to delete a SolicitudAccion entity.
     *
     * @param SolicitudAccion $solicitudAccion The SolicitudAccion entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(SolicitudAccion $solicitudAccion)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_solicitudaccion_delete', array('id' => $solicitudAccion->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
