<?php

namespace Kore\AgentBundle\Controller;

use Kore\AdminBundle\Entity\PersonaAccion;
use Kore\AgentBundle\Form\PersonaAccionType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Personaaccion controller.
 *
 */
class PersonaAccionController extends Controller
{

    /**
     * Lists all PersonaAccion entities.
     *
     */
    public function indexAction(Request $request)
    {
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $personaAccions = $em->getRepository('KoreAdminBundle:PersonaAccion')->findBy(array(), array($sort => $direction));
        else $personaAccions = $em->getRepository('KoreAdminBundle:PersonaAccion')->findAll();
        $paginator = $this->get('knp_paginator');
        $personaAccions = $paginator->paginate($personaAccions, $request->query->getInt('page', 1), 100);

        $deleteForms = array();
        foreach($personaAccions as $key => $personaAccion) {
            $deleteForms[] = $this->createDeleteForm($personaAccion)->createView();
        }

        return $this->render('KoreAgentBundle:PersonaAccion:index.html.twig', array(
            'personaAccions' => $personaAccions,
            'direction' => $direction,
            'sort' => $sort,
            'deleteForms' => $deleteForms,
        ));
    }

    /**
     * Creates a new PersonaAccion entity.
     *
     */
    public function newAction(Request $request)
    {
        $personaAccion = new PersonaAccion();
        $newForm = $this->createNewForm($personaAccion);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted()) {
            if($newForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($personaAccion);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'personaAccion.new.flash' );
                return $this->redirect($this->generateUrl('admin_personaaccion_index'));
            }
        }

        return $this->render('KoreAgentBundle:PersonaAccion:new.html.twig', array(
            'newForm' => $newForm->createView(),
        ));
    }

    /**
     * Creates a form to create a new PersonaAccion entity.
     *
     * @param PersonaAccion $personaAccion The PersonaAccion entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createNewForm(PersonaAccion $personaAccion)
    {
        return $this->createForm(new PersonaAccionType(), $personaAccion, array(
            'action' => $this->generateUrl('admin_personaaccion_new'),
        ));
    }

    /**
     * Finds and displays a PersonaAccion entity.
     *
     */
    public function showAction(PersonaAccion $personaAccion)
    {
        $editForm = $this->createEditForm($personaAccion);
        $deleteForm = $this->createDeleteForm($personaAccion);

        return $this->render('KoreAgentBundle:PersonaAccion:show.html.twig', array(
            'personaAccion' => $personaAccion,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing PersonaAccion entity.
     *
     */
    public function editAction(Request $request, PersonaAccion $personaAccion)
    {
        $editForm = $this->createEditForm($personaAccion);
        $deleteForm = $this->createDeleteForm($personaAccion);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()) {
            if($editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($personaAccion);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'personaAccion.edit.flash' );
                return $this->redirect($this->generateUrl('admin_personaaccion_index'));
            }
        }

        return $this->render('KoreAgentBundle:PersonaAccion:edit.html.twig', array(
            'personaAccion' => $personaAccion,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a PersonaAccion entity.
     *
     * @param PersonaAccion $personaAccion The PersonaAccion entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(PersonaAccion $personaAccion)
    {
        return $this->createForm(new PersonaAccionType(), $personaAccion, array(
            'action' => $this->generateUrl('admin_personaaccion_edit', array('id' => $personaAccion->getId())),
        ));
    }

    /**
     * Deletes a PersonaAccion entity.
     *
     */
    public function deleteAction(Request $request, PersonaAccion $personaAccion)
    {
        $deleteForm = $this->createDeleteForm($personaAccion);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($personaAccion);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'personaAccion.delete.flash' );
        }

        return $this->redirect($this->generateUrl('admin_personaaccion_index'));
    }

    /**
     * Creates a form to delete a PersonaAccion entity.
     *
     * @param PersonaAccion $personaAccion The PersonaAccion entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(PersonaAccion $personaAccion)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_personaaccion_delete', array('id' => $personaAccion->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
