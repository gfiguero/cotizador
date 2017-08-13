<?php

namespace Kore\AdminBundle\Controller;

use Kore\AdminBundle\Entity\Province;
use Kore\AdminBundle\Form\ProvinceType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Province controller.
 *
 */
class ProvinceController extends Controller
{

    /**
     * Lists all Province entities.
     *
     */
    public function indexAction(Request $request)
    {
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $provinces = $em->getRepository('KoreAdminBundle:Province')->findBy(array(), array($sort => $direction));
        else $provinces = $em->getRepository('KoreAdminBundle:Province')->findAll();
        $paginator = $this->get('knp_paginator');
        $provinces = $paginator->paginate($provinces, $request->query->getInt('page', 1), 100);

        $deleteForms = array();
        foreach($provinces as $key => $province) {
            $deleteForms[] = $this->createDeleteForm($province)->createView();
        }

        return $this->render('KoreAdminBundle:Province:index.html.twig', array(
            'provinces' => $provinces,
            'direction' => $direction,
            'sort' => $sort,
            'deleteForms' => $deleteForms,
        ));
    }

    /**
     * Creates a new Province entity.
     *
     */
    public function newAction(Request $request)
    {
        $province = new Province();
        $newForm = $this->createNewForm($province);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted()) {
            if($newForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($province);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'province.new.flash' );
                return $this->redirect($this->generateUrl('admin_province_index'));
            }
        }

        return $this->render('KoreAdminBundle:Province:new.html.twig', array(
            'newForm' => $newForm->createView(),
        ));
    }

    /**
     * Creates a form to create a new Province entity.
     *
     * @param Province $province The Province entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createNewForm(Province $province)
    {
        return $this->createForm(new ProvinceType(), $province, array(
            'action' => $this->generateUrl('admin_province_new'),
        ));
    }

    /**
     * Finds and displays a Province entity.
     *
     */
    public function showAction(Province $province)
    {
        $editForm = $this->createEditForm($province);
        $deleteForm = $this->createDeleteForm($province);

        return $this->render('KoreAdminBundle:Province:show.html.twig', array(
            'province' => $province,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Province entity.
     *
     */
    public function editAction(Request $request, Province $province)
    {
        $editForm = $this->createEditForm($province);
        $deleteForm = $this->createDeleteForm($province);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()) {
            if($editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($province);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'province.edit.flash' );
                return $this->redirect($this->generateUrl('admin_province_index'));
            }
        }

        return $this->render('KoreAdminBundle:Province:edit.html.twig', array(
            'province' => $province,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a Province entity.
     *
     * @param Province $province The Province entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Province $province)
    {
        return $this->createForm(new ProvinceType(), $province, array(
            'action' => $this->generateUrl('admin_province_edit', array('id' => $province->getId())),
        ));
    }

    /**
     * Deletes a Province entity.
     *
     */
    public function deleteAction(Request $request, Province $province)
    {
        $deleteForm = $this->createDeleteForm($province);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($province);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'province.delete.flash' );
        }

        return $this->redirect($this->generateUrl('admin_province_index'));
    }

    /**
     * Creates a form to delete a Province entity.
     *
     * @param Province $province The Province entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Province $province)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_province_delete', array('id' => $province->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
