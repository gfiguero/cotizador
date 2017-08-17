<?php

namespace Kore\AgentBundle\Controller;

use Kore\AdminBundle\Entity\Provider;
use Kore\AgentBundle\Form\ProviderType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Provider controller.
 *
 */
class ProviderController extends Controller
{

    /**
     * Lists all Provider entities.
     *
     */
    public function indexAction(Request $request)
    {
        $user = $this->getUser();
        $group = $user->getGroup();

        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $providers = $em->getRepository('KoreAdminBundle:Provider')->findBy(array('group' => $group), array($sort => $direction));
        else $providers = $em->getRepository('KoreAdminBundle:Provider')->findBy(array('group' => $group));
        $paginator = $this->get('knp_paginator');
        $providers = $paginator->paginate($providers, $request->query->getInt('page', 1), 100);

        $deleteForms = array();
        foreach($providers as $key => $provider) {
            $deleteForms[] = $this->createDeleteForm($provider)->createView();
        }

        return $this->render('KoreAgentBundle:Provider:index.html.twig', array(
            'providers' => $providers,
            'direction' => $direction,
            'sort' => $sort,
            'deleteForms' => $deleteForms,
        ));
    }

    /**
     * Creates a new Provider entity.
     *
     */
    public function newAction(Request $request)
    {
        $user = $this->getUser();
        $group = $user->getGroup();

        $provider = new Provider();
        $newForm = $this->createNewForm($provider);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted()) {
            if($newForm->isValid()) {
                $provider->setUser($user);
                $provider->setGroup($group);
                $em = $this->getDoctrine()->getManager();
                $em->persist($provider);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'provider.new.flash' );
                return $this->redirect($this->generateUrl('agent_provider_index'));
            }
        }

        return $this->render('KoreAgentBundle:Provider:new.html.twig', array(
            'newForm' => $newForm->createView(),
        ));
    }

    /**
     * Creates a form to create a new Provider entity.
     *
     * @param Provider $provider The Provider entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createNewForm(Provider $provider)
    {
        return $this->createForm(new ProviderType(), $provider, array(
            'action' => $this->generateUrl('agent_provider_new'),
        ));
    }

    /**
     * Finds and displays a Provider entity.
     *
     */
    public function showAction(Provider $provider)
    {
        $user = $this->getUser();
        $group = $user->getGroup();
        if ($group != $provider->getGroup()) return $this->redirect($this->generateUrl('agent_provider_index'));

        $editForm = $this->createEditForm($provider);
        $deleteForm = $this->createDeleteForm($provider);

        return $this->render('KoreAgentBundle:Provider:show.html.twig', array(
            'provider' => $provider,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Provider entity.
     *
     */
    public function editAction(Request $request, Provider $provider)
    {
        $user = $this->getUser();
        $group = $user->getGroup();
        if ($group != $provider->getGroup()) return $this->redirect($this->generateUrl('agent_provider_index'));

        $editForm = $this->createEditForm($provider);
        $deleteForm = $this->createDeleteForm($provider);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()) {
            if($editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($provider);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'provider.edit.flash' );
                return $this->redirect($this->generateUrl('agent_provider_index'));
            }
        }

        return $this->render('KoreAgentBundle:Provider:edit.html.twig', array(
            'provider' => $provider,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a Provider entity.
     *
     * @param Provider $provider The Provider entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Provider $provider)
    {
        return $this->createForm(new ProviderType(), $provider, array(
            'action' => $this->generateUrl('agent_provider_edit', array('id' => $provider->getId())),
        ));
    }

    /**
     * Deletes a Provider entity.
     *
     */
    public function deleteAction(Request $request, Provider $provider)
    {
        $user = $this->getUser();
        $group = $user->getGroup();
        if ($group != $provider->getGroup()) return $this->redirect($this->generateUrl('agent_provider_index'));

        $deleteForm = $this->createDeleteForm($provider);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($provider);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'provider.delete.flash' );
        }

        return $this->redirect($this->generateUrl('agent_provider_index'));
    }

    /**
     * Creates a form to delete a Provider entity.
     *
     * @param Provider $provider The Provider entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Provider $provider)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('agent_provider_delete', array('id' => $provider->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
