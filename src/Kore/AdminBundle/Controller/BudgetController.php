<?php

namespace Kore\AdminBundle\Controller;

use Kore\AdminBundle\Entity\Budget;
use Kore\AdminBundle\Form\BudgetType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Budget controller.
 *
 */
class BudgetController extends Controller
{

    /**
     * Lists all Budget entities.
     *
     */
    public function indexAction(Request $request)
    {
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $budgets = $em->getRepository('KoreAdminBundle:Budget')->findBy(array(), array($sort => $direction));
        else $budgets = $em->getRepository('KoreAdminBundle:Budget')->findAll();
        $paginator = $this->get('knp_paginator');
        $budgets = $paginator->paginate($budgets, $request->query->getInt('page', 1), 100);

        $deleteForms = array();
        foreach($budgets as $key => $budget) {
            $deleteForms[] = $this->createDeleteForm($budget)->createView();
        }

        return $this->render('KoreAdminBundle:Budget:index.html.twig', array(
            'budgets' => $budgets,
            'direction' => $direction,
            'sort' => $sort,
            'deleteForms' => $deleteForms,
        ));
    }

    /**
     * Creates a new Budget entity.
     *
     */
    public function newAction(Request $request)
    {
        $budget = new Budget();
        $newForm = $this->createNewForm($budget);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted()) {
            if($newForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($budget);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'budget.new.flash' );
                return $this->redirect($this->generateUrl('admin_budget_index'));
            }
        }

        return $this->render('KoreAdminBundle:Budget:new.html.twig', array(
            'newForm' => $newForm->createView(),
        ));
    }

    /**
     * Creates a form to create a new Budget entity.
     *
     * @param Budget $budget The Budget entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createNewForm(Budget $budget)
    {
        return $this->createForm(new BudgetType(), $budget, array(
            'action' => $this->generateUrl('admin_budget_new'),
        ));
    }

    /**
     * Finds and displays a Budget entity.
     *
     */
    public function showAction(Budget $budget)
    {
        $editForm = $this->createEditForm($budget);
        $deleteForm = $this->createDeleteForm($budget);

        return $this->render('KoreAdminBundle:Budget:show.html.twig', array(
            'budget' => $budget,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Budget entity.
     *
     */
    public function editAction(Request $request, Budget $budget)
    {
        $editForm = $this->createEditForm($budget);
        $deleteForm = $this->createDeleteForm($budget);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()) {
            if($editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($budget);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'budget.edit.flash' );
                return $this->redirect($this->generateUrl('admin_budget_index'));
            }
        }

        return $this->render('KoreAdminBundle:Budget:edit.html.twig', array(
            'budget' => $budget,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a Budget entity.
     *
     * @param Budget $budget The Budget entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Budget $budget)
    {
        return $this->createForm(new BudgetType(), $budget, array(
            'action' => $this->generateUrl('admin_budget_edit', array('id' => $budget->getId())),
        ));
    }

    /**
     * Deletes a Budget entity.
     *
     */
    public function deleteAction(Request $request, Budget $budget)
    {
        $deleteForm = $this->createDeleteForm($budget);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($budget);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'budget.delete.flash' );
        }

        return $this->redirect($this->generateUrl('admin_budget_index'));
    }

    /**
     * Creates a form to delete a Budget entity.
     *
     * @param Budget $budget The Budget entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Budget $budget)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_budget_delete', array('id' => $budget->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
