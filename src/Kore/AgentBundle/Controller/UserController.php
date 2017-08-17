<?php

namespace Kore\AgentBundle\Controller;

use Kore\AdminBundle\Entity\User;
use Kore\AgentBundle\Form\UserType;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

use FOS\UserBundle\Event\FilterUserResponseEvent;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\Form\Factory\FactoryInterface;
use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Model\UserInterface;
use FOS\UserBundle\Model\UserManagerInterface;

class UserController extends Controller
{
    public function editAction(Request $request)
    {
        $user = $this->getUser();
        $editForm = $this->createForm(new UserType(), $user);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()) {
            if($editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'user.edit.flash' );
                return $this->redirect($this->generateUrl('agent_user_edit'));
            }
        }

        return $this->render('KoreAgentBundle:User:edit.html.twig', array(
            'editForm' => $editForm->createView(),
        ));
    }

    public function showAction(Request $request)
    {
        $user = $this->getUser();
        return $this->render('KoreAgentBundle:User:show.html.twig', array(
            'user' => $user,
        ));
    }

    public function changePasswordAction(Request $request)
    {
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) throw new AccessDeniedException('This user does not have access to this section.');
        $dispatcher = $this->get('event_dispatcher');
        $event = new GetResponseUserEvent($user, $request);
        $dispatcher->dispatch(FOSUserEvents::CHANGE_PASSWORD_INITIALIZE, $event);
        if (null !== $event->getResponse()) return $event->getResponse();
        $formFactory = $this->get('fos_user.change_password.form.factory');
        $passwordForm = $formFactory->createForm();
        $passwordForm->setData($user);
        $passwordForm->handleRequest($request);

        if ($passwordForm->isSubmitted() && $passwordForm->isValid()) {
            $userManager = $this->get('fos_user.user_manager');
            $event = new FormEvent($passwordForm, $request);
            $dispatcher->dispatch(FOSUserEvents::CHANGE_PASSWORD_SUCCESS, $event);
            $userManager->updateUser($user);
            if (null === $response = $event->getResponse()) {
                $url = $this->generateUrl('agent_user_edit');
                $response = new RedirectResponse($url);
            }
            $dispatcher->dispatch(FOSUserEvents::CHANGE_PASSWORD_COMPLETED, new FilterUserResponseEvent($user, $request, $response));
            return $response;
        }

        return $this->render('KoreAgentBundle:User:changepassword.html.twig', array(
            'passwordForm' => $passwordForm->createView(),
        ));
    }
}
