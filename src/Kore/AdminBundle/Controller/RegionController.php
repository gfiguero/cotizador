<?php

namespace Kore\AdminBundle\Controller;

use Kore\AdminBundle\Entity\Region;
use Kore\AdminBundle\Form\RegionType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Region controller.
 *
 */
class RegionController extends Controller
{

    /**
     * Lists all Region entities.
     *
     */
    public function indexAction(Request $request)
    {
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $regions = $em->getRepository('KoreAdminBundle:Region')->findBy(array(), array($sort => $direction));
        else $regions = $em->getRepository('KoreAdminBundle:Region')->findAll();
        $paginator = $this->get('knp_paginator');
        $regions = $paginator->paginate($regions, $request->query->getInt('page', 1), 100);

        $deleteForms = array();
        foreach($regions as $key => $region) {
            $deleteForms[] = $this->createDeleteForm($region)->createView();
        }

        return $this->render('KoreAdminBundle:Region:index.html.twig', array(
            'regions' => $regions,
            'direction' => $direction,
            'sort' => $sort,
            'deleteForms' => $deleteForms,
        ));
    }

    /**
     * Creates a new Region entity.
     *
     */
    public function newAction(Request $request)
    {
        $region = new Region();
        $newForm = $this->createNewForm($region);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted()) {
            if($newForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($region);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'region.new.flash' );
                return $this->redirect($this->generateUrl('admin_region_index'));
            }
        }

        return $this->render('KoreAdminBundle:Region:new.html.twig', array(
            'newForm' => $newForm->createView(),
        ));
    }

    /**
     * Creates a form to create a new Region entity.
     *
     * @param Region $region The Region entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createNewForm(Region $region)
    {
        return $this->createForm(new RegionType(), $region, array(
            'action' => $this->generateUrl('admin_region_new'),
        ));
    }

    /**
     * Finds and displays a Region entity.
     *
     */
    public function showAction(Region $region)
    {
        $editForm = $this->createEditForm($region);
        $deleteForm = $this->createDeleteForm($region);

        return $this->render('KoreAdminBundle:Region:show.html.twig', array(
            'region' => $region,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Region entity.
     *
     */
    public function editAction(Request $request, Region $region)
    {
        $editForm = $this->createEditForm($region);
        $deleteForm = $this->createDeleteForm($region);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()) {
            if($editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($region);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'region.edit.flash' );
                return $this->redirect($this->generateUrl('admin_region_index'));
            }
        }

        return $this->render('KoreAdminBundle:Region:edit.html.twig', array(
            'region' => $region,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a Region entity.
     *
     * @param Region $region The Region entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Region $region)
    {
        return $this->createForm(new RegionType(), $region, array(
            'action' => $this->generateUrl('admin_region_edit', array('id' => $region->getId())),
        ));
    }

    /**
     * Deletes a Region entity.
     *
     */
    public function deleteAction(Request $request, Region $region)
    {
        $deleteForm = $this->createDeleteForm($region);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($region);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'region.delete.flash' );
        }

        return $this->redirect($this->generateUrl('admin_region_index'));
    }

    /**
     * Creates a form to delete a Region entity.
     *
     * @param Region $region The Region entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Region $region)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_region_delete', array('id' => $region->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
