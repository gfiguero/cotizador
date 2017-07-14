<?php

namespace Kore\AgentBundle\Controller;

use Kore\AdminBundle\Entity\RutaEstado;
use Kore\AgentBundle\Form\RutaEstadoType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Rutaestado controller.
 *
 */
class RutaEstadoController extends Controller
{

    /**
     * Lists all RutaEstado entities.
     *
     */
    public function indexAction(Request $request)
    {
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $rutaEstados = $em->getRepository('KoreAdminBundle:RutaEstado')->findBy(array(), array($sort => $direction));
        else $rutaEstados = $em->getRepository('KoreAdminBundle:RutaEstado')->findAll();
        $paginator = $this->get('knp_paginator');
        $rutaEstados = $paginator->paginate($rutaEstados, $request->query->getInt('page', 1), 100);

        $deleteForms = array();
        foreach($rutaEstados as $key => $rutaEstado) {
            $deleteForms[] = $this->createDeleteForm($rutaEstado)->createView();
        }

        return $this->render('KoreAgentBundle:RutaEstado:index.html.twig', array(
            'rutaEstados' => $rutaEstados,
            'direction' => $direction,
            'sort' => $sort,
            'deleteForms' => $deleteForms,
        ));
    }

    /**
     * Creates a new RutaEstado entity.
     *
     */
    public function newAction(Request $request)
    {
        $rutaEstado = new RutaEstado();
        $newForm = $this->createNewForm($rutaEstado);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted()) {
            if($newForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($rutaEstado);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'rutaEstado.new.flash' );
                return $this->redirect($this->generateUrl('admin_rutaestado_index'));
            }
        }

        return $this->render('KoreAgentBundle:RutaEstado:new.html.twig', array(
            'newForm' => $newForm->createView(),
        ));
    }

    /**
     * Creates a form to create a new RutaEstado entity.
     *
     * @param RutaEstado $rutaEstado The RutaEstado entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createNewForm(RutaEstado $rutaEstado)
    {
        return $this->createForm(new RutaEstadoType(), $rutaEstado, array(
            'action' => $this->generateUrl('admin_rutaestado_new'),
        ));
    }

    /**
     * Finds and displays a RutaEstado entity.
     *
     */
    public function showAction(RutaEstado $rutaEstado)
    {
        $editForm = $this->createEditForm($rutaEstado);
        $deleteForm = $this->createDeleteForm($rutaEstado);

        return $this->render('KoreAgentBundle:RutaEstado:show.html.twig', array(
            'rutaEstado' => $rutaEstado,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing RutaEstado entity.
     *
     */
    public function editAction(Request $request, RutaEstado $rutaEstado)
    {
        $editForm = $this->createEditForm($rutaEstado);
        $deleteForm = $this->createDeleteForm($rutaEstado);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()) {
            if($editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($rutaEstado);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'rutaEstado.edit.flash' );
                return $this->redirect($this->generateUrl('admin_rutaestado_index'));
            }
        }

        return $this->render('KoreAgentBundle:RutaEstado:edit.html.twig', array(
            'rutaEstado' => $rutaEstado,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a RutaEstado entity.
     *
     * @param RutaEstado $rutaEstado The RutaEstado entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(RutaEstado $rutaEstado)
    {
        return $this->createForm(new RutaEstadoType(), $rutaEstado, array(
            'action' => $this->generateUrl('admin_rutaestado_edit', array('id' => $rutaEstado->getId())),
        ));
    }

    /**
     * Deletes a RutaEstado entity.
     *
     */
    public function deleteAction(Request $request, RutaEstado $rutaEstado)
    {
        $deleteForm = $this->createDeleteForm($rutaEstado);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($rutaEstado);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'rutaEstado.delete.flash' );
        }

        return $this->redirect($this->generateUrl('admin_rutaestado_index'));
    }

    /**
     * Creates a form to delete a RutaEstado entity.
     *
     * @param RutaEstado $rutaEstado The RutaEstado entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(RutaEstado $rutaEstado)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_rutaestado_delete', array('id' => $rutaEstado->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
