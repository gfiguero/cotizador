<?php

namespace Kore\AdminBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

class Builder implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    public function topMenu(FactoryInterface $factory, array $options)
    {
        $topmenu = $factory->createItem('root');
        $topmenu->setChildrenAttribute('class', 'nav navbar-nav');
        $topmenu->setChildrenAttribute('id', 'top-menu');

//        $topmenu->addChild('topmenu.header', array('route' => 'admin_header_index'))->setAttributes(array('icon' => 'database fa-fw', 'translation_domain' => 'KoreAdminBundle'));
        $topmenu->addChild('topmenu.logout', array('route' => 'front_logout'))->setAttributes(array('icon' => 'sign-out fa-fw', 'translation_domain' => 'KoreFrontBundle'));

        return $topmenu;
    }

    public function sideMenu(FactoryInterface $factory, array $options)
    {
        $sidemenu = $factory->createItem('root');
        $sidemenu->setCurrent($this->container->get('request')->getRequestUri());
        $sidemenu->setChildrenAttribute('class', 'metismenu');
        $sidemenu->setChildrenAttribute('id', 'side-menu');

        $sidemenu->addChild('sidemenu.domicilio', array('route' => 'admin_domicilio_index'))->setExtras(array('icon' => 'database fa-fw', 'translation_domain' => 'KoreAdminBundle', 'routes' => 'admin_domicilio_index'));
        $sidemenu->addChild('sidemenu.encuestador', array('route' => 'admin_encuestador_index'))->setExtras(array('icon' => 'database fa-fw', 'translation_domain' => 'KoreAdminBundle', 'routes' => 'admin_encuestador_index'));
        $sidemenu->addChild('sidemenu.persona', array('route' => 'admin_persona_index'))->setExtras(array('icon' => 'database fa-fw', 'translation_domain' => 'KoreAdminBundle', 'routes' => 'admin_persona_index'));
        $sidemenu->addChild('sidemenu.personaaccion', array('route' => 'admin_personaaccion_index'))->setExtras(array('icon' => 'database fa-fw', 'translation_domain' => 'KoreAdminBundle', 'routes' => 'admin_personaaccion_index'));
        $sidemenu->addChild('sidemenu.ruta', array('route' => 'admin_ruta_index'))->setExtras(array('icon' => 'database fa-fw', 'translation_domain' => 'KoreAdminBundle', 'routes' => 'admin_ruta_index'));
        $sidemenu->addChild('sidemenu.rutaestado', array('route' => 'admin_rutaestado_index'))->setExtras(array('icon' => 'database fa-fw', 'translation_domain' => 'KoreAdminBundle', 'routes' => 'admin_rutaestado_index'));
        $sidemenu->addChild('sidemenu.solicitud', array('route' => 'admin_solicitud_index'))->setExtras(array('icon' => 'database fa-fw', 'translation_domain' => 'KoreAdminBundle', 'routes' => 'admin_solicitud_index'));
        $sidemenu->addChild('sidemenu.solicitudaccion', array('route' => 'admin_solicitudaccion_index'))->setExtras(array('icon' => 'database fa-fw', 'translation_domain' => 'KoreAdminBundle', 'routes' => 'admin_solicitudaccion_index'));
        $sidemenu->addChild('sidemenu.solicitudestado', array('route' => 'admin_solicitudestado_index'))->setExtras(array('icon' => 'database fa-fw', 'translation_domain' => 'KoreAdminBundle', 'routes' => 'admin_solicitudestado_index'));

        return $sidemenu;
    }

}