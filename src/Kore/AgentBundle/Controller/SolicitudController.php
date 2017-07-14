<?php

namespace Kore\AgentBundle\Controller;

use Kore\AdminBundle\Entity\Solicitud;
use Kore\AdminBundle\Entity\RutaEstado;
use Kore\AgentBundle\Form\SolicitudType;
use Kore\AgentBundle\Form\SolicitudBuscarType;
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

        return $this->render('KoreAgentBundle:Solicitud:index.html.twig', array(
            'solicituds' => $solicituds,
            'direction' => $direction,
            'sort' => $sort,
            'deleteForms' => $deleteForms,
        ));
    }

    public function rutaestadoAction(Request $request, $codigo)
    {
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($codigo) $solicitudes = $em->getRepository('KoreAdminBundle:Solicitud')->findByRutaEstadoCodigo($codigo, $sort, $direction);
        else $solicitudes = $em->getRepository('KoreAdminBundle:Solicitud')->findByRutaNull($sort, $direction);

        $paginator = $this->get('knp_paginator');
        $solicitudes = $paginator->paginate($solicitudes, $request->query->getInt('page', 1), 100);

        return $this->render('KoreAgentBundle:Solicitud:rutaestado.html.twig', array(
            'direction'   => $direction,
            'sort'        => $sort,
            'solicitudes' => $solicitudes,
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

        return $this->render('KoreAgentBundle:Solicitud:new.html.twig', array(
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
        $deleteForm = $this->createDeleteForm($solicitud);

        return $this->render('KoreAgentBundle:Solicitud:show.html.twig', array(
            'solicitud' => $solicitud,
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    public function buscarAction(Request $request)
    {
        $buscarForm = $this->createForm(new SolicitudBuscarType());
        $buscarForm->handleRequest($request);
        $em = $this->getDoctrine()->getManager();

        if ($buscarForm->isSubmitted()) {
            if($buscarForm->isValid()) {
                $id = $buscarForm->get('id')->getData();
                $solicitud = $em->getRepository('KoreAdminBundle:Solicitud')->findOneById($id);
                if($solicitud) {
                    return $this->redirect($this->generateUrl('agent_solicitud_show', array('id' => $solicitud->getId())));
                }
                $request->getSession()->getFlashBag()->add( 'warning', 'solicitud.buscar.flash' );
            }
        }

        $solicitudes = $em->getRepository('KoreAdminBundle:Solicitud')->findBy(array(), array('created_at' => 'DESC'), 200);

        return $this->render('KoreAgentBundle:Solicitud:buscar.html.twig', array(
            'buscarForm' => $buscarForm->createView(),
            'solicitudes' => $solicitudes,
        ));
    }

    /**
     * Displays a form to edit an existing Solicitud entity.
     *
     */
    public function editAction(Request $request, Solicitud $solicitud)
    {
        $editForm = $this->createForm(new SolicitudType(), $solicitud);
        $deleteForm = $this->createDeleteForm($solicitud);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()) {
            if($editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($solicitud);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'solicitud.edit.flash' );
                return $this->redirect($this->generateUrl('agent_solicitud_show', array('id' => $solicitud->getId())));
            }
        }

        return $this->render('KoreAgentBundle:Solicitud:edit.html.twig', array(
            'solicitud' => $solicitud,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
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

        return $this->redirect($this->generateUrl('admin_solicitud_estado'));
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
            ->setAction($this->generateUrl('agent_solicitud_delete', array('id' => $solicitud->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
