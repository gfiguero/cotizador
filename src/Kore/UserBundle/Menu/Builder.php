<?php

namespace Kore\UserBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

class Builder implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    public function topMenu(FactoryInterface $factory, array $options)
    {
        $checker = $this->container->get('security.authorization_checker');

        $topmenu = $factory->createItem('root');
        $topmenu->setChildrenAttribute('class', 'nav navbar-nav navbar-right');
        $topmenu->setChildrenAttribute('id', 'top-menu');

//        $topmenu->addChild('topmenu.register', array('route' => 'fos_user_registration_register'))->setExtras(array('icon' => 'edit fa-fw', 'translation_domain' => 'KoreUserBundle'));
        $topmenu->addChild('topmenu.login', array('route' => 'fos_user_security_login'))->setExtras(array('icon' => 'sign-in fa-fw', 'translation_domain' => 'KoreUserBundle'));
        $topmenu->addChild('topmenu.reset', array('route' => 'fos_user_resetting_request'))->setExtras(array('icon' => 'repeat fa-fw', 'translation_domain' => 'KoreUserBundle'));

        if ($checker->isGranted('ROLE_USER')) {
            $topmenu->addChild('topmenu.profile', array('route' => 'fos_user_profile_show'))->setExtras(array('icon' => 'id-card fa-fw', 'translation_domain' => 'KoreUserBundle'));
            $topmenu->addChild('topmenu.changepassword', array('route' => 'fos_user_change_password'))->setExtras(array('icon' => 'unlock-alt fa-fw', 'translation_domain' => 'KoreUserBundle'));
            $topmenu->addChild('topmenu.logout', array('route' => 'fos_user_security_logout'))->setExtras(array('icon' => 'sign-out fa-fw', 'translation_domain' => 'KoreUserBundle'));
        }

        return $topmenu;
    }

}