<?php

namespace Kore\AdminBundle\Controller;

use Kore\AdminBundle\Entity\Commune;
use Kore\AdminBundle\Form\CommuneType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Commune controller.
 *
 */
class CommuneController extends Controller
{

    /**
     * Lists all Commune entities.
     *
     */
    public function indexAction(Request $request)
    {
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $communes = $em->getRepository('KoreAdminBundle:Commune')->findBy(array(), array($sort => $direction));
        else $communes = $em->getRepository('KoreAdminBundle:Commune')->findAll();
        $paginator = $this->get('knp_paginator');
        $communes = $paginator->paginate($communes, $request->query->getInt('page', 1), 100);

        $deleteForms = array();
        foreach($communes as $key => $commune) {
            $deleteForms[] = $this->createDeleteForm($commune)->createView();
        }

        return $this->render('KoreAdminBundle:Commune:index.html.twig', array(
            'communes' => $communes,
            'direction' => $direction,
            'sort' => $sort,
            'deleteForms' => $deleteForms,
        ));
    }

    /**
     * Creates a new Commune entity.
     *
     */
    public function newAction(Request $request)
    {
        $commune = new Commune();
        $newForm = $this->createNewForm($commune);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted()) {
            if($newForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($commune);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'commune.new.flash' );
                return $this->redirect($this->generateUrl('admin_commune_index'));
            }
        }

        return $this->render('KoreAdminBundle:Commune:new.html.twig', array(
            'newForm' => $newForm->createView(),
        ));
    }

    /**
     * Creates a form to create a new Commune entity.
     *
     * @param Commune $commune The Commune entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createNewForm(Commune $commune)
    {
        return $this->createForm(new CommuneType(), $commune, array(
            'action' => $this->generateUrl('admin_commune_new'),
        ));
    }

    /**
     * Finds and displays a Commune entity.
     *
     */
    public function showAction(Commune $commune)
    {
        $editForm = $this->createEditForm($commune);
        $deleteForm = $this->createDeleteForm($commune);

        return $this->render('KoreAdminBundle:Commune:show.html.twig', array(
            'commune' => $commune,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Commune entity.
     *
     */
    public function editAction(Request $request, Commune $commune)
    {
        $editForm = $this->createEditForm($commune);
        $deleteForm = $this->createDeleteForm($commune);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()) {
            if($editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($commune);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'commune.edit.flash' );
                return $this->redirect($this->generateUrl('admin_commune_index'));
            }
        }

        return $this->render('KoreAdminBundle:Commune:edit.html.twig', array(
            'commune' => $commune,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a Commune entity.
     *
     * @param Commune $commune The Commune entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Commune $commune)
    {
        return $this->createForm(new CommuneType(), $commune, array(
            'action' => $this->generateUrl('admin_commune_edit', array('id' => $commune->getId())),
        ));
    }

    /**
     * Deletes a Commune entity.
     *
     */
    public function deleteAction(Request $request, Commune $commune)
    {
        $deleteForm = $this->createDeleteForm($commune);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($commune);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'commune.delete.flash' );
        }

        return $this->redirect($this->generateUrl('admin_commune_index'));
    }

    /**
     * Creates a form to delete a Commune entity.
     *
     * @param Commune $commune The Commune entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Commune $commune)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_commune_delete', array('id' => $commune->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
