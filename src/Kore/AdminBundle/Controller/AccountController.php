<?php

namespace Kore\AdminBundle\Controller;

use Kore\AdminBundle\Entity\Account;
use Kore\AdminBundle\Form\AccountType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Account controller.
 *
 */
class AccountController extends Controller
{

    /**
     * Lists all Account entities.
     *
     */
    public function indexAction(Request $request)
    {
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $accounts = $em->getRepository('KoreAdminBundle:Account')->findBy(array(), array($sort => $direction));
        else $accounts = $em->getRepository('KoreAdminBundle:Account')->findAll();
        $paginator = $this->get('knp_paginator');
        $accounts = $paginator->paginate($accounts, $request->query->getInt('page', 1), 100);

        $deleteForms = array();
        foreach($accounts as $key => $account) {
            $deleteForms[] = $this->createDeleteForm($account)->createView();
        }

        return $this->render('KoreAdminBundle:Account:index.html.twig', array(
            'accounts' => $accounts,
            'direction' => $direction,
            'sort' => $sort,
            'deleteForms' => $deleteForms,
        ));
    }

    /**
     * Creates a new Account entity.
     *
     */
    public function newAction(Request $request)
    {
        $account = new Account();
        $newForm = $this->createNewForm($account);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted()) {
            if($newForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($account);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'account.new.flash' );
                return $this->redirect($this->generateUrl('admin_account_index'));
            }
        }

        return $this->render('KoreAdminBundle:Account:new.html.twig', array(
            'newForm' => $newForm->createView(),
        ));
    }

    /**
     * Creates a form to create a new Account entity.
     *
     * @param Account $account The Account entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createNewForm(Account $account)
    {
        return $this->createForm(new AccountType(), $account, array(
            'action' => $this->generateUrl('admin_account_new'),
        ));
    }

    /**
     * Finds and displays a Account entity.
     *
     */
    public function showAction(Account $account)
    {
        $editForm = $this->createEditForm($account);
        $deleteForm = $this->createDeleteForm($account);

        return $this->render('KoreAdminBundle:Account:show.html.twig', array(
            'account' => $account,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Account entity.
     *
     */
    public function editAction(Request $request, Account $account)
    {
        $editForm = $this->createEditForm($account);
        $deleteForm = $this->createDeleteForm($account);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()) {
            if($editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($account);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'account.edit.flash' );
                return $this->redirect($this->generateUrl('admin_account_index'));
            }
        }

        return $this->render('KoreAdminBundle:Account:edit.html.twig', array(
            'account' => $account,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a Account entity.
     *
     * @param Account $account The Account entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Account $account)
    {
        return $this->createForm(new AccountType(), $account, array(
            'action' => $this->generateUrl('admin_account_edit', array('id' => $account->getId())),
        ));
    }

    /**
     * Deletes a Account entity.
     *
     */
    public function deleteAction(Request $request, Account $account)
    {
        $deleteForm = $this->createDeleteForm($account);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($account);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'account.delete.flash' );
        }

        return $this->redirect($this->generateUrl('admin_account_index'));
    }

    /**
     * Creates a form to delete a Account entity.
     *
     * @param Account $account The Account entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Account $account)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_account_delete', array('id' => $account->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
