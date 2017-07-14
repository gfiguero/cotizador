<?php

namespace Kore\AgentBundle\Controller;

use Kore\AdminBundle\Entity\Encuestador;
use Kore\AgentBundle\Form\EncuestadorType;
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
        if($sort) $encuestadores = $em->getRepository('KoreAdminBundle:Encuestador')->findBy(array(), array($sort => $direction));
        else $encuestadores = $em->getRepository('KoreAdminBundle:Encuestador')->findAll();
        $paginator = $this->get('knp_paginator');
        $encuestadores = $paginator->paginate($encuestadores, $request->query->getInt('page', 1), 100);

        return $this->render('KoreAgentBundle:Encuestador:index.html.twig', array(
            'encuestadores' => $encuestadores,
            'direction' => $direction,
            'sort' => $sort,
        ));
    }

    /**
     * Creates a new Encuestador entity.
     *
     */
    public function newAction(Request $request)
    {
        $encuestador = new Encuestador();
        $newForm = $this->createForm(new EncuestadorType(), $encuestador);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted()) {
            if($newForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($encuestador);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'encuestador.new.flash' );
                return $this->redirect($this->generateUrl('agent_encuestador_index'));
            }
        }

        return $this->render('KoreAgentBundle:Encuestador:new.html.twig', array(
            'newForm' => $newForm->createView(),
        ));
    }

    /**
     * Finds and displays a Encuestador entity.
     *
     */
    public function showAction(Encuestador $encuestador)
    {
        return $this->render('KoreAgentBundle:Encuestador:show.html.twig', array(
            'encuestador' => $encuestador,
        ));
    }

    /**
     * Displays a form to edit an existing Encuestador entity.
     *
     */
    public function editAction(Request $request, Encuestador $encuestador)
    {
        $editForm = $this->createForm(new EncuestadorType(), $encuestador);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()) {
            if($editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($encuestador);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'encuestador.edit.flash' );
                return $this->redirect($this->generateUrl('agent_encuestador_index'));
            }
        }

        return $this->render('KoreAgentBundle:Encuestador:edit.html.twig', array(
            'encuestador' => $encuestador,
            'editForm' => $editForm->createView(),
        ));
    }

}
