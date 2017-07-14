<?php

namespace Kore\AdminBundle\Controller;

use Kore\AdminBundle\Entity\Persona;
use Kore\AdminBundle\Form\PersonaType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Persona controller.
 *
 */
class PersonaController extends Controller
{

    /**
     * Lists all Persona entities.
     *
     */
    public function indexAction(Request $request)
    {
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $personas = $em->getRepository('KoreAdminBundle:Persona')->findBy(array(), array($sort => $direction));
        else $personas = $em->getRepository('KoreAdminBundle:Persona')->findAll();
        $paginator = $this->get('knp_paginator');
        $personas = $paginator->paginate($personas, $request->query->getInt('page', 1), 100);

        $deleteForms = array();
        foreach($personas as $key => $persona) {
            $deleteForms[] = $this->createDeleteForm($persona)->createView();
        }

        return $this->render('KoreAdminBundle:Persona:index.html.twig', array(
            'personas' => $personas,
            'direction' => $direction,
            'sort' => $sort,
            'deleteForms' => $deleteForms,
        ));
    }

    /**
     * Creates a new Persona entity.
     *
     */
    public function newAction(Request $request)
    {
        $persona = new Persona();
        $newForm = $this->createNewForm($persona);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted()) {
            if($newForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($persona);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'persona.new.flash' );
                return $this->redirect($this->generateUrl('admin_persona_index'));
            }
        }

        return $this->render('KoreAdminBundle:Persona:new.html.twig', array(
            'newForm' => $newForm->createView(),
        ));
    }

    /**
     * Creates a form to create a new Persona entity.
     *
     * @param Persona $persona The Persona entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createNewForm(Persona $persona)
    {
        return $this->createForm(new PersonaType(), $persona, array(
            'action' => $this->generateUrl('admin_persona_new'),
        ));
    }

    /**
     * Finds and displays a Persona entity.
     *
     */
    public function showAction(Persona $persona)
    {
        $editForm = $this->createEditForm($persona);
        $deleteForm = $this->createDeleteForm($persona);

        return $this->render('KoreAdminBundle:Persona:show.html.twig', array(
            'persona' => $persona,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Persona entity.
     *
     */
    public function editAction(Request $request, Persona $persona)
    {
        $editForm = $this->createEditForm($persona);
        $deleteForm = $this->createDeleteForm($persona);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()) {
            if($editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($persona);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'persona.edit.flash' );
                return $this->redirect($this->generateUrl('admin_persona_index'));
            }
        }

        return $this->render('KoreAdminBundle:Persona:edit.html.twig', array(
            'persona' => $persona,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a Persona entity.
     *
     * @param Persona $persona The Persona entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Persona $persona)
    {
        return $this->createForm(new PersonaType(), $persona, array(
            'action' => $this->generateUrl('admin_persona_edit', array('id' => $persona->getId())),
        ));
    }

    /**
     * Deletes a Persona entity.
     *
     */
    public function deleteAction(Request $request, Persona $persona)
    {
        $deleteForm = $this->createDeleteForm($persona);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($persona);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'persona.delete.flash' );
        }

        return $this->redirect($this->generateUrl('admin_persona_index'));
    }

    /**
     * Creates a form to delete a Persona entity.
     *
     * @param Persona $persona The Persona entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Persona $persona)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_persona_delete', array('id' => $persona->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
