<?php

namespace Kore\AgentBundle\Controller;

use Kore\AdminBundle\Entity\Group;
use Kore\AgentBundle\Form\GroupType;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class GroupController extends Controller
{
    public function editAction(Request $request)
    {
        $user = $this->getUser();
        $group = $user->getGroup();
        $editForm = $this->createForm(new GroupType(), $group);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()) {
            if($editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'group.edit.flash' );
                return $this->redirect($this->generateUrl('agent_group_edit'));
            }
        }

        return $this->render('KoreAgentBundle:Group:edit.html.twig', array(
            'editForm' => $editForm->createView(),
        ));
    }

    public function showAction(Request $request)
    {
        $user = $this->getUser();
        $group = $user->getGroup();
        return $this->render('KoreAgentBundle:Group:show.html.twig', array(
            'group' => $group,
        ));
    }

}
