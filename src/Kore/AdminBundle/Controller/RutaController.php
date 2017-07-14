<?php

namespace Kore\AdminBundle\Controller;

use Kore\AdminBundle\Entity\Ruta;
use Kore\AdminBundle\Form\RutaType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Rutum controller.
 *
 */
class RutaController extends Controller
{

    /**
     * Lists all Ruta entities.
     *
     */
    public function indexAction(Request $request)
    {
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $rutas = $em->getRepository('KoreAdminBundle:Ruta')->findBy(array(), array($sort => $direction));
        else $rutas = $em->getRepository('KoreAdminBundle:Ruta')->findAll();
        $paginator = $this->get('knp_paginator');
        $rutas = $paginator->paginate($rutas, $request->query->getInt('page', 1), 100);

        $deleteForms = array();
        foreach($rutas as $key => $rutum) {
            $deleteForms[] = $this->createDeleteForm($rutum)->createView();
        }

        return $this->render('KoreAdminBundle:Ruta:index.html.twig', array(
            'rutas' => $rutas,
            'direction' => $direction,
            'sort' => $sort,
            'deleteForms' => $deleteForms,
        ));
    }

    /**
     * Creates a new Ruta entity.
     *
     */
    public function newAction(Request $request)
    {
        $rutum = new Ruta();
        $newForm = $this->createNewForm($rutum);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted()) {
            if($newForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($rutum);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'rutum.new.flash' );
                return $this->redirect($this->generateUrl('admin_ruta_index'));
            }
        }

        return $this->render('KoreAdminBundle:Ruta:new.html.twig', array(
            'newForm' => $newForm->createView(),
        ));
    }

    /**
     * Creates a form to create a new Ruta entity.
     *
     * @param Ruta $rutum The Ruta entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createNewForm(Ruta $rutum)
    {
        return $this->createForm(new RutaType(), $rutum, array(
            'action' => $this->generateUrl('admin_ruta_new'),
        ));
    }

    /**
     * Finds and displays a Ruta entity.
     *
     */
    public function showAction(Ruta $rutum)
    {
        $editForm = $this->createEditForm($rutum);
        $deleteForm = $this->createDeleteForm($rutum);

        return $this->render('KoreAdminBundle:Ruta:show.html.twig', array(
            'rutum' => $rutum,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Ruta entity.
     *
     */
    public function editAction(Request $request, Ruta $rutum)
    {
        $editForm = $this->createEditForm($rutum);
        $deleteForm = $this->createDeleteForm($rutum);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()) {
            if($editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($rutum);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'rutum.edit.flash' );
                return $this->redirect($this->generateUrl('admin_ruta_index'));
            }
        }

        return $this->render('KoreAdminBundle:Ruta:edit.html.twig', array(
            'rutum' => $rutum,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a Ruta entity.
     *
     * @param Ruta $rutum The Ruta entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Ruta $rutum)
    {
        return $this->createForm(new RutaType(), $rutum, array(
            'action' => $this->generateUrl('admin_ruta_edit', array('id' => $rutum->getId())),
        ));
    }

    /**
     * Deletes a Ruta entity.
     *
     */
    public function deleteAction(Request $request, Ruta $rutum)
    {
        $deleteForm = $this->createDeleteForm($rutum);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($rutum);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'rutum.delete.flash' );
        }

        return $this->redirect($this->generateUrl('admin_ruta_index'));
    }

    /**
     * Creates a form to delete a Ruta entity.
     *
     * @param Ruta $rutum The Ruta entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Ruta $rutum)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_ruta_delete', array('id' => $rutum->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
