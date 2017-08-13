<?php

namespace Kore\AdminBundle\Controller;

use Kore\AdminBundle\Entity\Issuer;
use Kore\AdminBundle\Form\IssuerType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Issuer controller.
 *
 */
class IssuerController extends Controller
{

    /**
     * Lists all Issuer entities.
     *
     */
    public function indexAction(Request $request)
    {
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $issuers = $em->getRepository('KoreAdminBundle:Issuer')->findBy(array(), array($sort => $direction));
        else $issuers = $em->getRepository('KoreAdminBundle:Issuer')->findAll();
        $paginator = $this->get('knp_paginator');
        $issuers = $paginator->paginate($issuers, $request->query->getInt('page', 1), 100);

        $deleteForms = array();
        foreach($issuers as $key => $issuer) {
            $deleteForms[] = $this->createDeleteForm($issuer)->createView();
        }

        return $this->render('KoreAdminBundle:Issuer:index.html.twig', array(
            'issuers' => $issuers,
            'direction' => $direction,
            'sort' => $sort,
            'deleteForms' => $deleteForms,
        ));
    }

    /**
     * Creates a new Issuer entity.
     *
     */
    public function newAction(Request $request)
    {
        $issuer = new Issuer();
        $newForm = $this->createNewForm($issuer);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted()) {
            if($newForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($issuer);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'issuer.new.flash' );
                return $this->redirect($this->generateUrl('admin_issuer_index'));
            }
        }

        return $this->render('KoreAdminBundle:Issuer:new.html.twig', array(
            'newForm' => $newForm->createView(),
        ));
    }

    /**
     * Creates a form to create a new Issuer entity.
     *
     * @param Issuer $issuer The Issuer entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createNewForm(Issuer $issuer)
    {
        return $this->createForm(new IssuerType(), $issuer, array(
            'action' => $this->generateUrl('admin_issuer_new'),
        ));
    }

    /**
     * Finds and displays a Issuer entity.
     *
     */
    public function showAction(Issuer $issuer)
    {
        $editForm = $this->createEditForm($issuer);
        $deleteForm = $this->createDeleteForm($issuer);

        return $this->render('KoreAdminBundle:Issuer:show.html.twig', array(
            'issuer' => $issuer,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Issuer entity.
     *
     */
    public function editAction(Request $request, Issuer $issuer)
    {
        $editForm = $this->createEditForm($issuer);
        $deleteForm = $this->createDeleteForm($issuer);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()) {
            if($editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($issuer);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'issuer.edit.flash' );
                return $this->redirect($this->generateUrl('admin_issuer_index'));
            }
        }

        return $this->render('KoreAdminBundle:Issuer:edit.html.twig', array(
            'issuer' => $issuer,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a Issuer entity.
     *
     * @param Issuer $issuer The Issuer entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Issuer $issuer)
    {
        return $this->createForm(new IssuerType(), $issuer, array(
            'action' => $this->generateUrl('admin_issuer_edit', array('id' => $issuer->getId())),
        ));
    }

    /**
     * Deletes a Issuer entity.
     *
     */
    public function deleteAction(Request $request, Issuer $issuer)
    {
        $deleteForm = $this->createDeleteForm($issuer);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($issuer);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'issuer.delete.flash' );
        }

        return $this->redirect($this->generateUrl('admin_issuer_index'));
    }

    /**
     * Creates a form to delete a Issuer entity.
     *
     * @param Issuer $issuer The Issuer entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Issuer $issuer)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_issuer_delete', array('id' => $issuer->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
