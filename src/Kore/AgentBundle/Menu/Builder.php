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
        $checker = $this->container->get('security.authorization_checker');
        $user = $this->container->get('security.token_storage')->getToken()->getUser();

        $topmenu = $factory->createItem('root');
        $topmenu->setChildrenAttribute('class', 'nav navbar-nav navbar-right');
        $topmenu->setChildrenAttribute('id', 'top-menu');

        if ($checker->isGranted('ROLE_USER')) {

            $topmenu->addChild('topmenu.group');
            $topmenu['topmenu.group']->setUri('#');
            $topmenu['topmenu.group']->setLabel($user->getGroup());
            $topmenu['topmenu.group']->setLinkAttributes(array('class' => 'dropdown-toggle', 'data-toggle' => 'dropdown', 'role' => 'button', 'aria-haspopup' => 'true', 'aria-expanded' => 'false'));
            $topmenu['topmenu.group']->setExtras(array('dropdown' => true, 'translation_domain' => 'KoreAgentBundle'));
            $topmenu['topmenu.group']->setChildrenAttributes(array('class' => 'dropdown-menu'));

            $topmenu['topmenu.group']->addChild('topmenu.settings', array('route' => 'agent_group_edit'));
            $topmenu['topmenu.group']['topmenu.settings']->setExtras(array('translation_domain' => 'KoreAgentBundle', 'icon' => 'user fa-fw'));

            $topmenu->addChild('topmenu.user');
            $topmenu['topmenu.user']->setUri('#');
            $topmenu['topmenu.user']->setLabel($user->getEmail());
            $topmenu['topmenu.user']->setLinkAttributes(array('class' => 'dropdown-toggle', 'data-toggle' => 'dropdown', 'role' => 'button', 'aria-haspopup' => 'true', 'aria-expanded' => 'false'));
            $topmenu['topmenu.user']->setExtras(array('dropdown' => true, 'translation_domain' => 'KoreAgentBundle'));
            $topmenu['topmenu.user']->setChildrenAttributes(array('class' => 'dropdown-menu'));

            $topmenu['topmenu.user']->addChild('topmenu.profile', array('route' => 'agent_user_edit'));
            $topmenu['topmenu.user']['topmenu.profile']->setExtras(array('translation_domain' => 'KoreAgentBundle', 'icon' => 'user fa-fw'));

            $topmenu['topmenu.user']->addChild('topmenu.changepassword', array('route' => 'agent_user_change_password'));
            $topmenu['topmenu.user']['topmenu.changepassword']->setExtras(array('translation_domain' => 'KoreAgentBundle', 'icon' => 'unlock-alt fa-fw'));

            $topmenu['topmenu.user']->addChild('topmenu.logout', array('route' => 'fos_user_security_logout'));
            $topmenu['topmenu.user']['topmenu.logout']->setExtras(array('translation_domain' => 'KoreAgentBundle', 'icon' => 'sign-out fa-fw'));

        }

        return $topmenu;
    }

    public function sideMenu(FactoryInterface $factory, array $options)
    {
        $sidemenu = $factory->createItem('root');
        $sidemenu->setCurrent($this->container->get('request')->getRequestUri());
        $sidemenu->setChildrenAttribute('class', 'metismenu');
        $sidemenu->setChildrenAttribute('id', 'side-menu');

        $sidemenu->addChild('sidemenu.provider.root', array('route' => 'agent_provider_index'))->setExtras(array('translation_domain' => 'KoreAgentBundle', 'routes' => array(
            'agent_provider_index',
            'agent_provider_new',
            'agent_provider_show',
            'agent_provider_edit',
        )));
        $sidemenu->addChild('sidemenu.client.root', array('route' => 'agent_client_index'))->setExtras(array('translation_domain' => 'KoreAgentBundle', 'routes' => array(
            'agent_client_index',
            'agent_client_new',
            'agent_client_show',
            'agent_client_edit',
        )));
        $sidemenu->addChild('sidemenu.seller.root', array('route' => 'agent_seller_index'))->setExtras(array('translation_domain' => 'KoreAgentBundle', 'routes' => array(
            'agent_seller_index',
            'agent_seller_new',
            'agent_seller_show',
            'agent_seller_edit',
        )));
        $sidemenu->addChild('sidemenu.product.root', array('route' => 'agent_product_index'))->setExtras(array('translation_domain' => 'KoreAgentBundle', 'routes' => array(
            'agent_product_index',
            'agent_product_new',
            'agent_product_show',
            'agent_product_edit',
        )));
        $sidemenu->addChild('sidemenu.note.root', array('route' => 'agent_note_index'))->setExtras(array('translation_domain' => 'KoreAgentBundle', 'routes' => array(
            'agent_note_index',
            'agent_note_new',
            'agent_note_show',
            'agent_note_edit',
        )));
        $sidemenu->addChild('sidemenu.budget.root', array('route' => 'agent_budget_index'))->setExtras(array('translation_domain' => 'KoreAgentBundle', 'routes' => array(
            'agent_budget_index',
            'agent_budget_new',
            'agent_budget_show',
            'agent_budget_edit',
        )));
/*
        $sidemenu->addChild('sidemenu.item.root', array('route' => 'agent_item_index'))->setExtras(array('translation_domain' => 'KoreAgentBundle', 'routes' => array(
            'agent_item_index',
            'agent_item_new',
            'agent_item_show',
            'agent_item_edit',
        )));
*/

        return $sidemenu;
    }

}