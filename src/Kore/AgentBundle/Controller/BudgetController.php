<?php

namespace Kore\AgentBundle\Controller;

use Kore\AdminBundle\Entity\Budget;
use Kore\AgentBundle\Form\BudgetType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

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

        return $this->render('KoreAgentBundle:Budget:index.html.twig', array(
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
                $budget->setReferencePrices();
                $em = $this->getDoctrine()->getManager();
                $em->persist($budget);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'budget.new.flash' );
                return $this->redirect($this->generateUrl('agent_budget_show', array('id' => $budget->getId())));
            }
        }

        return $this->render('KoreAgentBundle:Budget:new.html.twig', array(
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
            'action' => $this->generateUrl('agent_budget_new'),
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

        return $this->render('KoreAgentBundle:Budget:show.html.twig', array(
            'budget' => $budget,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    public function exportAction(Budget $budget)
    {
        return $this->render('KoreAgentBundle:Budget:export.html.twig', array(
            'budget' => $budget,
        ));
    }

    public function pdfAction(Budget $budget)
    {
        $html = $this->renderView('KoreAgentBundle:Budget:export.html.twig', array('budget' => $budget));
        return new Response($this->get('knp_snappy.pdf')->getOutputFromHtml($html), 200, array('Content-Type' => 'application/pdf'));
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
                $budget->setReferencePrices();
                $em = $this->getDoctrine()->getManager();
                $em->persist($budget);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'budget.edit.flash' );
                return $this->redirect($this->generateUrl('agent_budget_show', array('id' => $budget->getId())));
            }
        }

        return $this->render('KoreAgentBundle:Budget:edit.html.twig', array(
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
            'action' => $this->generateUrl('agent_budget_edit', array('id' => $budget->getId())),
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

        return $this->redirect($this->generateUrl('agent_budget_index'));
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
            ->setAction($this->generateUrl('agent_budget_delete', array('id' => $budget->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
