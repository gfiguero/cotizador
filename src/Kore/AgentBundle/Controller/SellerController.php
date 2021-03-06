<?php

namespace Kore\AgentBundle\Controller;

use Kore\AdminBundle\Entity\Seller;
use Kore\AgentBundle\Form\SellerType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Seller controller.
 *
 */
class SellerController extends Controller
{

    /**
     * Lists all Seller entities.
     *
     */
    public function indexAction(Request $request)
    {
        $user = $this->getUser();
        $account = $user->getAccount();

        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $sellers = $em->getRepository('KoreAdminBundle:Seller')->findBy(array('account' => $account), array($sort => $direction));
        else $sellers = $em->getRepository('KoreAdminBundle:Seller')->findBy(array('account' => $account));
        $paginator = $this->get('knp_paginator');
        $sellers = $paginator->paginate($sellers, $request->query->getInt('page', 1), 100);

        $deleteForms = array();
        foreach($sellers as $key => $seller) {
            $deleteForms[] = $this->createDeleteForm($seller)->createView();
        }

        return $this->render('KoreAgentBundle:Seller:index.html.twig', array(
            'sellers' => $sellers,
            'direction' => $direction,
            'sort' => $sort,
            'deleteForms' => $deleteForms,
        ));
    }

    /**
     * Creates a new Seller entity.
     *
     */
    public function newAction(Request $request)
    {
        $user = $this->getUser();
        $account = $user->getAccount();

        $seller = new Seller();
        $newForm = $this->createNewForm($seller);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted()) {
            if($newForm->isValid()) {
                $seller->setUser($user);
                $seller->setAccount($account);
                $em = $this->getDoctrine()->getManager();
                $em->persist($seller);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'seller.new.flash' );
                return $this->redirect($this->generateUrl('agent_seller_index'));
            }
        }

        return $this->render('KoreAgentBundle:Seller:new.html.twig', array(
            'newForm' => $newForm->createView(),
        ));
    }

    /**
     * Creates a form to create a new Seller entity.
     *
     * @param Seller $seller The Seller entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createNewForm(Seller $seller)
    {
        return $this->createForm(new SellerType(), $seller, array(
            'action' => $this->generateUrl('agent_seller_new'),
        ));
    }

    /**
     * Finds and displays a Seller entity.
     *
     */
    public function showAction(Seller $seller)
    {
        $user = $this->getUser();
        $account = $user->getAccount();
        if ($account != $seller->getAccount()) return $this->redirect($this->generateUrl('agent_seller_index'));

        $editForm = $this->createEditForm($seller);
        $deleteForm = $this->createDeleteForm($seller);

        return $this->render('KoreAgentBundle:Seller:show.html.twig', array(
            'seller' => $seller,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Seller entity.
     *
     */
    public function editAction(Request $request, Seller $seller)
    {
        $user = $this->getUser();
        $account = $user->getAccount();
        if ($account != $seller->getAccount()) return $this->redirect($this->generateUrl('agent_seller_index'));

        $editForm = $this->createEditForm($seller);
        $deleteForm = $this->createDeleteForm($seller);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()) {
            if($editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($seller);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'seller.edit.flash' );
                return $this->redirect($this->generateUrl('agent_seller_index'));
            }
        }

        return $this->render('KoreAgentBundle:Seller:edit.html.twig', array(
            'seller' => $seller,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a Seller entity.
     *
     * @param Seller $seller The Seller entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Seller $seller)
    {
        return $this->createForm(new SellerType(), $seller, array(
            'action' => $this->generateUrl('agent_seller_edit', array('id' => $seller->getId())),
        ));
    }

    /**
     * Deletes a Seller entity.
     *
     */
    public function deleteAction(Request $request, Seller $seller)
    {
        $user = $this->getUser();
        $account = $user->getAccount();
        if ($account != $seller->getAccount()) return $this->redirect($this->generateUrl('agent_seller_index'));

        $deleteForm = $this->createDeleteForm($seller);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($seller);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'seller.delete.flash' );
        }

        return $this->redirect($this->generateUrl('agent_seller_index'));
    }

    /**
     * Creates a form to delete a Seller entity.
     *
     * @param Seller $seller The Seller entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Seller $seller)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('agent_seller_delete', array('id' => $seller->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
