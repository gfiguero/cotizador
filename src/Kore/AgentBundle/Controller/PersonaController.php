<?php

namespace Kore\AgentBundle\Controller;

use Kore\AdminBundle\Entity\Persona;

use Kore\AgentBundle\Form\PersonaType;
use Kore\AgentBundle\Form\PersonaExistenteBuscarType;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Persona controller.
 *
 */
class PersonaController extends Controller
{
    /**
     * Muestra un formulario de búsqueda de un entidad Persona y redirige si la encuentra.
     *
     */
    public function buscarAction(Request $request)
    {
        $buscarForm = $this->createForm(new PersonaExistenteBuscarType());
        $buscarForm->handleRequest($request);

        if ($buscarForm->isSubmitted()) {
            if ($buscarForm->isValid()) {

                $em = $this->getDoctrine()->getManager();
                $rut = $buscarForm->get('rut')->getData();
                $persona = $em->getRepository('KoreAdminBundle:Persona')->findOneByRut($rut);
                if ($persona) return $this->redirect($this->generateUrl('agent_persona_show', array( 'id' => $persona->getId())));
            }
        }

        return $this->render('KoreAgentBundle:Persona:buscar.html.twig', array(
            'buscarForm' => $buscarForm->createView(),
        ));
    }

    /**
     * Encuentra y muestra la entidad Persona.
     *
     */
    public function showAction(Persona $persona)
    {
        $domicilios = $persona->getDomicilios();
        $solicitudes = $persona->getSolicitudes();
        return $this->render('KoreAgentBundle:Persona:show.html.twig', array(
            'persona'    => $persona,
            'domicilios' => $domicilios,
            'solicitudes' => $solicitudes,
        ));
    }

    /**
     * Muestra un formulario de edición para una entidad Persona existente.
     *
     */
    public function editAction(Request $request, Persona $persona)
    {
        $editForm = $this->createForm(new PersonaType(), $persona);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()) {
            if($editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($persona);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'persona.edit.flash' );
                return $this->redirect($this->generateUrl('agent_persona_show', array( 'id' => $persona->getId())));
            }
        }

        return $this->render('KoreAgentBundle:Persona:edit.html.twig', array(
            'persona' => $persona,
            'editForm' => $editForm->createView(),
        ));
    }

}
