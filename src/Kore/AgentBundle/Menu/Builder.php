<?php

namespace Kore\AgentBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

class Builder implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    public function topMenu(FactoryInterface $factory, array $options)
    {
        $topmenu = $factory->createItem('root');
        $topmenu->setChildrenAttribute('class', 'nav navbar-nav navbar-right');
        $topmenu->setChildrenAttribute('id', 'top-menu');

        $topmenu->addChild('topmenu.solicitud', array('route' => 'agent_solicitudproceso_personabuscar'))->setExtras(array('translation_domain' => 'KoreAgentBundle'));
        $topmenu->addChild('topmenu.ruta', array('route' => 'agent_ruta_new'))->setExtras(array('translation_domain' => 'KoreAgentBundle'));
        $topmenu->addChild('topmenu.logout', array('route' => 'logout'))->setExtras(array('translation_domain' => 'KoreAgentBundle'));

        return $topmenu;
    }

    public function sideMenu(FactoryInterface $factory, array $options)
    {
        $sidemenu = $factory->createItem('root');
        $sidemenu->setChildrenAttribute('class', 'metismenu');
        $sidemenu->setChildrenAttribute('id', 'side-menu');

// Menú Solicitud
        $sidemenu->addChild('sidemenu.solicitud.root')->setExtras(array('translation_domain' => 'KoreAgentBundle'));
        $sidemenu['sidemenu.solicitud.root']->setLabelAttributes(array('class' => 'has-arrow'));
        $sidemenu['sidemenu.solicitud.root']->addChild('sidemenu.solicitud.indexnull', array('route' => 'agent_solicitud_rutaestado_null'))->setExtras(array('translation_domain' => 'KoreAgentBundle', 'routes' => 'agent_solicitud_rutaestado_null'));
        $sidemenu['sidemenu.solicitud.root']->addChild('sidemenu.solicitud.indexR00', array('route' => 'agent_solicitud_rutaestado_0'))->setExtras(array('translation_domain' => 'KoreAgentBundle', 'routes' => 'agent_solicitud_rutaestado_0'));
        $sidemenu['sidemenu.solicitud.root']->addChild('sidemenu.solicitud.indexR05', array('route' => 'agent_solicitud_rutaestado_5'))->setExtras(array('translation_domain' => 'KoreAgentBundle', 'routes' => 'agent_solicitud_rutaestado_5'));
//        $sidemenu['sidemenu.solicitud.root']->addChild('sidemenu.solicitud.indexR10', array('route' => 'agent_solicitud_rutaestado', 'routeParameters' => array('codigo' => 'R10')))->setExtras(array('translation_domain' => 'KoreAgentBundle',));
        $sidemenu['sidemenu.solicitud.root']->addChild('sidemenu.solicitud.proceso', array('route' => 'agent_solicitudproceso_personabuscar'))
            ->setExtras(array('translation_domain' => 'KoreAgentBundle', 'routes' => array(
                    'agent_solicitudproceso_personabuscar',
                    'agent_solicitudproceso_personanueva',
                    'agent_solicitudproceso_personaexistente',
                    'agent_solicitudproceso_domicilio',
                    'agent_solicitudproceso_solicitud',
                ),
            ));
        $sidemenu['sidemenu.solicitud.root']->addChild('sidemenu.solicitud.show', array('route' => 'agent_solicitud_buscar'))
            ->setExtras(array('translation_domain' => 'KoreAgentBundle', 'routes' => array('agent_solicitud_buscar', 'agent_solicitud_show')));

// Menú Ruta
        $sidemenu->addChild('sidemenu.ruta.root')->setExtras(array('translation_domain' => 'KoreAgentBundle', 'routes' => array('agent_ruta_edit')));
        $sidemenu['sidemenu.ruta.root']->setLabelAttributes(array('class' => 'has-arrow'));
        $sidemenu['sidemenu.ruta.root']->addChild('sidemenu.ruta.indexR00', array('route' => 'agent_ruta_estado_0'))->setExtras(array('translation_domain' => 'KoreAgentBundle','routes' => 'agent_ruta_estado_0'));
        $sidemenu['sidemenu.ruta.root']->addChild('sidemenu.ruta.indexR05', array('route' => 'agent_ruta_estado_5'))->setExtras(array('translation_domain' => 'KoreAgentBundle','routes' => 'agent_ruta_estado_5'));
        $sidemenu['sidemenu.ruta.root']->addChild('sidemenu.ruta.indexR10', array('route' => 'agent_ruta_estado_10'))->setExtras(array('translation_domain' => 'KoreAgentBundle','routes' => 'agent_ruta_estado_10'));
        $sidemenu['sidemenu.ruta.root']->addChild('sidemenu.ruta.new', array('route' => 'agent_ruta_new'))->setExtras(array('translation_domain' => 'KoreAgentBundle','routes' => 'agent_ruta_new'));
        $sidemenu['sidemenu.ruta.root']->addChild('sidemenu.ruta.buscar', array('route' => 'agent_ruta_buscar'))
            ->setExtras(array('translation_domain' => 'KoreAgentBundle','routes' => array('agent_ruta_show', 'agent_ruta_buscar', 'agent_ruta_receipt', 'agent_ruta_edit')));

// Menú Encuestador
        $sidemenu->addChild('sidemenu.encuestador.root', array('route' => 'agent_encuestador_index'))
            ->setExtras(array('translation_domain' => 'KoreAgentBundle','routes' => array('agent_encuestador_index', 'agent_encuestador_new', 'agent_encuestador_edit', 'agent_encuestador_show')));

// Menú Persona
        $sidemenu->addChild('sidemenu.persona.root', array('route' => 'agent_persona_buscar'))
            ->setExtras(array('translation_domain' => 'KoreAgentBundle','routes' => array('agent_persona_buscar', 'agent_persona_show', 'agent_persona_edit')));
/*
        $sidemenu->addChild('sidemenu.persona.root')->setExtras(array('translation_domain' => 'KoreAgentBundle'));
        $sidemenu['sidemenu.persona.root']->setLabelAttributes(array('class' => 'has-arrow'));
        $sidemenu['sidemenu.persona.root']->addChild('sidemenu.persona.buscar', array('route' => 'agent_persona_buscar'))->setExtras(array('translation_domain' => 'KoreAgentBundle','routes' => 'agent_persona_buscar'));
*/
// Menú Domicilio
//        $sidemenu->addChild('sidemenu.domicilio', array('route' => 'agent_domicilio_index'))->setExtras(array('translation_domain' => 'KoreAgentBundle','routes' => 'agent_domicilio_index'));



//        $sidemenu->addChild('sidemenu.solicitudaccion', array('route' => 'agent_solicitudaccion_index'))->setExtras(array('icon' => 'database fa-fw', 'translation_domain' => 'KoreAgentBundle', 'routes' => 'agent_solicitudaccion_index'));
//        $sidemenu->addChild('sidemenu.solicitudestado', array('route' => 'agent_solicitudestado_index'))->setExtras(array('icon' => 'database fa-fw', 'translation_domain' => 'KoreAgentBundle', 'routes' => 'agent_solicitudestado_index'));

        return $sidemenu;
    }

}