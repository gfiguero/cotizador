<?php

namespace Kore\AgentBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Kore\AdminBundle\Entity\Persona;
use Kore\AgentBundle\Form\PersonaType;
use Kore\AgentBundle\Form\PersonaBuscarType;
use Kore\AdminBundle\Entity\Domicilio;
use Kore\AgentBundle\Form\DomicilioType;
use Kore\AgentBundle\Form\DomicilioBuscarType;
use Kore\AdminBundle\Entity\Solicitud;
use Kore\AgentBundle\Form\SolicitudType;
use Kore\AgentBundle\Form\SolicitudProcesoType;

use Kore\AdminBundle\Validator\Constraints\Rut;
use Symfony\Component\Validator\Constraints\NotBlank;

class SolicitudProcesoController extends Controller
{

    public function personaBuscarAction(Request $request)
    {
        $personaBuscarForm = $this->createPersonaBuscarForm();
        $personaBuscarForm->handleRequest($request);

        if ($personaBuscarForm->isSubmitted()) {
            if ($personaBuscarForm->isValid()) {

                $em = $this->getDoctrine()->getManager();
                $rut = $personaBuscarForm->get('rut')->getData();
                $persona = $em->getRepository('KoreAdminBundle:Persona')->findOneByRut($rut);
                if ($persona) {
                    return $this->redirect($this->generateUrl('agent_solicitudproceso_personaexistente', array( 'persona' => $persona->getId())));
                }

                return $this->redirect($this->generateUrl('agent_solicitudproceso_personanueva', array( 'rut' => $rut )));
            }
        }

        return $this->render('KoreAgentBundle:SolicitudProceso:personabuscar.html.twig', array(
            'personaBuscarForm' => $personaBuscarForm->createView(),
        ));
    }

    private function createPersonaBuscarForm()
    {
        return $this->createForm(new PersonaBuscarType());
    }

    public function personaNuevaAction(Request $request, $rut)
    {
        $persona = new Persona();
        $persona->setRut($rut);
        $personaForm = $this->createForm(new PersonaType(), $persona);
        $personaForm->handleRequest($request);

        if ($personaForm->isSubmitted()) {
            if ($personaForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($persona);
                $em->flush();
                return $this->redirect($this->generateUrl('agent_solicitudproceso_domicilio', array( 'persona' => $persona->getId() )));
            }
        }

        return $this->render('KoreAgentBundle:SolicitudProceso:persona.html.twig', array(
            'personaForm'   => $personaForm->createView()
        ));
    }

    public function personaExistenteAction(Request $request, Persona $persona)
    {
        $personaForm = $this->createForm(new PersonaType(), $persona);
        $personaForm->handleRequest($request);

        if ($personaForm->isSubmitted()) {
            if ($personaForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($persona);
                $em->flush();
                return $this->redirect($this->generateUrl('agent_solicitudproceso_domicilio', array( 'persona' => $persona->getId() )));
            }
        }

        return $this->render('KoreAgentBundle:SolicitudProceso:persona.html.twig', array(
            'personaForm'   => $personaForm->createView()
        ));
    }

    public function domicilioAction(Request $request, Persona $persona)
    {
        $em = $this->getDoctrine()->getManager();
        $domicilio = new Domicilio();
        $domicilioForm = $this->createForm(new DomicilioType(), $domicilio);
        $domicilioForm->handleRequest($request);

        if ($domicilioForm->isSubmitted()) {
            if ($domicilioForm->isValid()) {
                $domicilio->setPersona($persona);
                $em->persist($domicilio);
                $em->flush();
                return $this->redirect($this->generateUrl('agent_solicitudproceso_domicilio', array( 'persona' => $persona->getId() )));
//                return $this->redirect($this->generateUrl('agent_solicitudproceso_solicitud', array( 'domicilio' => $domicilio->getId() )));
            }
        }

        $domicilioBuscarForm = $this->createForm(new DomicilioBuscarType());
        $domicilios = $em->getRepository('KoreAdminBundle:Domicilio')->findByPersona($persona, array('created_at' => 'ASC'));

        return $this->render('KoreAgentBundle:SolicitudProceso:domicilio.html.twig', array(
            'domicilioBuscarForm' => $domicilioBuscarForm->createView(),
            'domicilioForm' => $domicilioForm->createView(),
            'domicilios' => $domicilios,
            'persona' => $persona,
        ));
    }




    public function solicitudAction(Request $request, Domicilio $domicilio)
    {
        $em = $this->getDoctrine()->getManager();
        $rol = $domicilio->getRol();
        $persona = $domicilio->getPersona();
        $solicitudesPersona = $em->getRepository('KoreAdminBundle:Solicitud')->findByPersonaId($persona->getId());
        if($rol) $solicitudesDomicilio = $em->getRepository('KoreAdminBundle:Solicitud')->findByRol($rol);
        else $solicitudesDomicilio = $domicilio->getSolicitudes();
        $solicitud = new Solicitud();
        $solicitudForm = $this->createForm(new SolicitudProcesoType(), $solicitud);
        $solicitudForm->handleRequest($request);

        if ($solicitudForm->isSubmitted()) {
            if ($solicitudForm->isValid()) {
                $estadoInicial = $em->getRepository('KoreAdminBundle:SolicitudEstado')->findOneByCodigo('S00');
                $solicitud->setEstado($estadoInicial);
                $solicitud->setDomicilio($domicilio);
                $solicitud->setPersona($persona);
                $em->persist($solicitud);
                $em->flush();
                return $this->redirect($this->generateUrl('agent_solicitud_show', array( 'id' => $solicitud->getId() )));
            }
        }

        return $this->render('KoreAgentBundle:SolicitudProceso:solicitud.html.twig', array(
            'solicitudForm'        => $solicitudForm->createView(),
            'solicitudesPersona'   => $solicitudesPersona,
            'solicitudesDomicilio' => $solicitudesDomicilio,
            'domicilio'            => $domicilio,
            'persona'              => $persona,
        ));
    }

    public function solicitudIngresarAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $persona = $em->getRepository('KoreAgentBundle:Persona')->find($id);
        $domicilio = $em->getRepository('KoreAgentBundle:Domicilio')->findOneByPersona($id, array('createdAt' => 'DESC'));
        $solicitud = new SolicitudFichaSocial();

        $solicitudForm = $this->solicitudForm($solicitud, $persona);
        $solicitudForm->handleRequest($request);

        if ($solicitudForm->isValid()) {
            $solicitud->setPersona($persona);
            $solicitud->setDomicilio($domicilio);
            $estado = $em->getRepository('KoreAgentBundle:EstadoSolicitudFichaSocial')->findOneByCodigo('S00');
            $solicitud->setEstado($estado);
            $em->persist($solicitud);
            $em->flush();
            $descripcion = 'Tipo:'.$solicitud->getTipo()->getNombre();
            $this->personaEvento($persona->getId(), 5, $this->getUser()->getId(), $descripcion);
            $this->solicitudEvento($solicitud->getId(), 5, $this->getUser()->getId(), 'Solicitud ingresada');
            $request->getSession()->getFlashBag()->add(
                'noticia',
                'La solicitud ha sido ingresada satisfactoriamente.'
            );
            return $this->redirect($this->generateUrl('solicitudesfichasocial'));
            //return $this->redirect($this->generateUrl('proceso_finalizar', array('id' => $id)));
        }
        return $this->render('KoreAgentBundle:ProcesoSolicitud:domicilio.html.twig', array(
            'solicitudForm' => $solicitudForm->createView(),
            'solicitud'     => $solicitud,
            'domicilio'     => $domicilio,
            'persona'       => $persona,
        ));
    }

    private function solicitudEvento($solicitudId, $tipoEventoId, $usuarioId, $descripcion){
        $entity = new EventoSolicitud();
        $em = $this->getDoctrine()->getManager();

        $solicitud = $em->getRepository('KoreAgentBundle:SolicitudFichaSocial')->find($solicitudId);
        $tipoEvento = $em->getRepository('KoreAgentBundle:TipoEvento')->find($tipoEventoId);
        $usuario = $em->getRepository('KoreAgentBundle:Usuario')->find($usuarioId);

        $entity->setTipo($tipoEvento);
        $entity->setSolicitud($solicitud);
        $entity->setUsuario($usuario);
        $entity->setDescripcion($descripcion);

        $em->persist($entity);
        $em->flush();

    }

    private function personaEvento($personaId, $tipoEventoId, $usuarioId, $descripcion){
        $entity = new eventoPersona();
        $em = $this->getDoctrine()->getManager();

        $persona = $em->getRepository('KoreAgentBundle:Persona')->find($personaId);
        $tipoEvento = $em->getRepository('KoreAgentBundle:TipoEvento')->find($tipoEventoId);
        $usuario = $em->getRepository('KoreAgentBundle:Usuario')->find($usuarioId);

        $entity->setTipo($tipoEvento);
        $entity->setPersona($persona);
        $entity->setUsuario($usuario);
        $entity->setDescripcion($descripcion);

        $em->persist($entity);
        $em->flush();

    }
}