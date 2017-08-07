<?php

namespace Kore\AgentBundle\Controller;

use Kore\AdminBundle\Entity\Client;
use Kore\AgentBundle\Form\ClientType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Client controller.
 *
 */
class ClientController extends Controller
{

    /**
     * Lists all Client entities.
     *
     */
    public function indexAction(Request $request)
    {
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $clients = $em->getRepository('KoreAdminBundle:Client')->findBy(array(), array($sort => $direction));
        else $clients = $em->getRepository('KoreAdminBundle:Client')->findAll();
        $paginator = $this->get('knp_paginator');
        $clients = $paginator->paginate($clients, $request->query->getInt('page', 1), 100);

        $deleteForms = array();
        foreach($clients as $key => $client) {
            $deleteForms[] = $this->createDeleteForm($client)->createView();
        }

        return $this->render('KoreAgentBundle:Client:index.html.twig', array(
            'clients' => $clients,
            'direction' => $direction,
            'sort' => $sort,
            'deleteForms' => $deleteForms,
        ));
    }

    /**
     * Creates a new Client entity.
     *
     */
    public function newAction(Request $request)
    {
        $client = new Client();
        $newForm = $this->createNewForm($client);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted()) {
            if($newForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($client);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'client.new.flash' );
                return $this->redirect($this->generateUrl('agent_client_index'));
            }
        }

        return $this->render('KoreAgentBundle:Client:new.html.twig', array(
            'newForm' => $newForm->createView(),
        ));
    }

    /**
     * Creates a form to create a new Client entity.
     *
     * @param Client $client The Client entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createNewForm(Client $client)
    {
        return $this->createForm(new ClientType(), $client, array(
            'action' => $this->generateUrl('agent_client_new'),
        ));
    }

    /**
     * Finds and displays a Client entity.
     *
     */
    public function showAction(Client $client)
    {
        $editForm = $this->createEditForm($client);
        $deleteForm = $this->createDeleteForm($client);

        return $this->render('KoreAgentBundle:Client:show.html.twig', array(
            'client' => $client,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Client entity.
     *
     */
    public function editAction(Request $request, Client $client)
    {
        $editForm = $this->createEditForm($client);
        $deleteForm = $this->createDeleteForm($client);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()) {
            if($editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($client);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'client.edit.flash' );
                return $this->redirect($this->generateUrl('agent_client_index'));
            }
        }

        return $this->render('KoreAgentBundle:Client:edit.html.twig', array(
            'client' => $client,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a Client entity.
     *
     * @param Client $client The Client entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Client $client)
    {
        return $this->createForm(new ClientType(), $client, array(
            'action' => $this->generateUrl('agent_client_edit', array('id' => $client->getId())),
        ));
    }

    /**
     * Deletes a Client entity.
     *
     */
    public function deleteAction(Request $request, Client $client)
    {
        $deleteForm = $this->createDeleteForm($client);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($client);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'client.delete.flash' );
        }

        return $this->redirect($this->generateUrl('agent_client_index'));
    }

    /**
     * Creates a form to delete a Client entity.
     *
     * @param Client $client The Client entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Client $client)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('agent_client_delete', array('id' => $client->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
