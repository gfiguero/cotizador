<?php

namespace Kore\AgentBundle\Controller;

use Kore\AdminBundle\Entity\Encuestador;
use Kore\AgentBundle\Form\EncuestadorType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Resumen controller.
 *
 */
class ResumenController extends Controller
{

    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $solicitudes['totales'] = $em->getRepository('KoreAdminBundle:Solicitud')->count();
        $solicitudes['370'] = $em->getRepository('KoreAdminBundle:Solicitud')->count(370);
        $solicitudes['190'] = $em->getRepository('KoreAdminBundle:Solicitud')->count(190);
        $solicitudes['rutanull'] = $em->getRepository('KoreAdminBundle:Solicitud')->countByRutaNull();
        $solicitudes['rutanueva'] = $em->getRepository('KoreAdminBundle:Solicitud')->countByRutaEstadoCodigo('R00');
        $solicitudes['rutaenviada'] = $em->getRepository('KoreAdminBundle:Solicitud')->countByRutaEstadoCodigo('R05');
        $solicitudes['rutaterminada'] = $em->getRepository('KoreAdminBundle:Solicitud')->countByRutaEstadoCodigo('R10');


        $rutas['totales'] = $em->getRepository('KoreAdminBundle:Ruta')->count();
        $rutas['nueva'] = $em->getRepository('KoreAdminBundle:Ruta')->countByEstadoCodigo('R00');
        $rutas['enviada'] = $em->getRepository('KoreAdminBundle:Ruta')->countByEstadoCodigo('R05');
        $rutas['terminada'] = $em->getRepository('KoreAdminBundle:Ruta')->countByEstadoCodigo('R10');

        $domicilios['sinrol'] = $em->getRepository('KoreAdminBundle:Domicilio')->count(false);
        $domicilios['enrolados'] = $em->getRepository('KoreAdminBundle:Domicilio')->count(true);
        $domicilios['roles'] = $em->getRepository('KoreAdminBundle:Domicilio')->countRoles();

        $personas['totales'] = $em->getRepository('KoreAdminBundle:Persona')->count();

        return $this->render('KoreAgentBundle:Resumen:index.html.twig', array(
            'solicitudes' => $solicitudes,
            'rutas' => $rutas,
            'domicilios' => $domicilios,
            'personas' => $personas,
        ));
    }

}
