<?php

namespace Kore\AgentBundle\Controller;

use Kore\AdminBundle\Entity\Note;
use Kore\AgentBundle\Form\NoteType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Note controller.
 *
 */
class NoteController extends Controller
{

    /**
     * Lists all Note entities.
     *
     */
    public function indexAction(Request $request)
    {
        $user = $this->getUser();
        $account = $user->getAccount();

        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $notes = $em->getRepository('KoreAdminBundle:Note')->findBy(array('account' => $account), array($sort => $direction));
        else $notes = $em->getRepository('KoreAdminBundle:Note')->findBy(array('account' => $account));
        $paginator = $this->get('knp_paginator');
        $notes = $paginator->paginate($notes, $request->query->getInt('page', 1), 100);

        $deleteForms = array();
        foreach($notes as $key => $note) {
            $deleteForms[] = $this->createDeleteForm($note)->createView();
        }

        return $this->render('KoreAgentBundle:Note:index.html.twig', array(
            'notes' => $notes,
            'direction' => $direction,
            'sort' => $sort,
            'deleteForms' => $deleteForms,
        ));
    }

    /**
     * Creates a new Note entity.
     *
     */
    public function newAction(Request $request)
    {
        $user = $this->getUser();
        $account = $user->getAccount();

        $note = new Note();
        $newForm = $this->createNewForm($note);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted()) {
            if($newForm->isValid()) {
                $note->setUser($user);
                $note->setAccount($account);
                $em = $this->getDoctrine()->getManager();
                $em->persist($note);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'note.new.flash' );
                return $this->redirect($this->generateUrl('agent_note_index'));
            }
        }

        return $this->render('KoreAgentBundle:Note:new.html.twig', array(
            'newForm' => $newForm->createView(),
        ));
    }

    /**
     * Creates a form to create a new Note entity.
     *
     * @param Note $note The Note entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createNewForm(Note $note)
    {
        return $this->createForm(new NoteType(), $note, array(
            'action' => $this->generateUrl('agent_note_new'),
        ));
    }

    /**
     * Finds and displays a Note entity.
     *
     */
    public function showAction(Note $note)
    {
        $user = $this->getUser();
        $account = $user->getAccount();
        if ($account != $note->getAccount()) return $this->redirect($this->generateUrl('agent_note_index'));

        $editForm = $this->createEditForm($note);
        $deleteForm = $this->createDeleteForm($note);

        return $this->render('KoreAgentBundle:Note:show.html.twig', array(
            'note' => $note,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Note entity.
     *
     */
    public function editAction(Request $request, Note $note)
    {
        $user = $this->getUser();
        $account = $user->getAccount();
        if ($account != $note->getAccount()) return $this->redirect($this->generateUrl('agent_note_index'));

        $editForm = $this->createEditForm($note);
        $deleteForm = $this->createDeleteForm($note);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()) {
            if($editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($note);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'note.edit.flash' );
                return $this->redirect($this->generateUrl('agent_note_index'));
            }
        }

        return $this->render('KoreAgentBundle:Note:edit.html.twig', array(
            'note' => $note,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a Note entity.
     *
     * @param Note $note The Note entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Note $note)
    {
        return $this->createForm(new NoteType(), $note, array(
            'action' => $this->generateUrl('agent_note_edit', array('id' => $note->getId())),
        ));
    }

    /**
     * Deletes a Note entity.
     *
     */
    public function deleteAction(Request $request, Note $note)
    {
        $user = $this->getUser();
        $account = $user->getAccount();
        if ($account != $note->getAccount()) return $this->redirect($this->generateUrl('agent_note_index'));

        $deleteForm = $this->createDeleteForm($note);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($note);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'note.delete.flash' );
        }

        return $this->redirect($this->generateUrl('agent_note_index'));
    }

    /**
     * Creates a form to delete a Note entity.
     *
     * @param Note $note The Note entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Note $note)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('agent_note_delete', array('id' => $note->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
