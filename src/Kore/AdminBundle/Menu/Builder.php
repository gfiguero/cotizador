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
        $topmenu->setChildrenAttribute('class', 'nav navbar-nav navbar-right');
        $topmenu->setChildrenAttribute('id', 'top-menu');

//        $topmenu->addChild('topmenu.header', array('route' => 'admin_header_index'))->setAttributes(array('icon' => 'database fa-fw', 'translation_domain' => 'KoreAdminBundle'));
//        $topmenu->addChild('topmenu.logout', array('route' => 'front_logout'))->setAttributes(array('icon' => 'sign-out fa-fw', 'translation_domain' => 'KoreFrontBundle'));
        $topmenu->addChild('topmenu.group.root', array('route' => 'fos_user_group_list'))->setExtras(array('translation_domain' => 'KoreAdminBundle', 'routes' => array(
            'admin_group_index',
            'admin_group_new',
            'admin_group_show',
            'admin_group_edit',
        )));
        $topmenu->addChild('topmenu.account.root', array('route' => 'admin_account_index'))->setExtras(array('translation_domain' => 'KoreAdminBundle', 'routes' => array(
            'admin_account_index',
            'admin_account_new',
            'admin_account_show',
            'admin_account_edit',
        )));
        $topmenu->addChild('topmenu.user.root', array('route' => 'admin_user_index'))->setExtras(array('translation_domain' => 'KoreAdminBundle', 'routes' => array(
            'admin_user_index',
            'admin_user_new',
            'admin_user_show',
            'admin_user_edit',
        )));

        return $topmenu;
    }

    public function sideMenu(FactoryInterface $factory, array $options)
    {
        $sidemenu = $factory->createItem('root');
        $sidemenu->setCurrent($this->container->get('request')->getRequestUri());
        $sidemenu->setChildrenAttribute('class', 'metismenu');
        $sidemenu->setChildrenAttribute('id', 'side-menu');

/*
        $sidemenu->addChild('sidemenu.commune.root', array('route' => 'admin_commune_index'))->setExtras(array('translation_domain' => 'KoreAdminBundle', 'routes' => array(
            'admin_commune_index',
            'admin_commune_new',
            'admin_commune_show',
            'admin_commune_edit',
        )));
        $sidemenu->addChild('sidemenu.province.root', array('route' => 'admin_province_index'))->setExtras(array('translation_domain' => 'KoreAdminBundle', 'routes' => array(
            'admin_province_index',
            'admin_province_new',
            'admin_province_show',
            'admin_province_edit',
        )));
        $sidemenu->addChild('sidemenu.region.root', array('route' => 'admin_region_index'))->setExtras(array('translation_domain' => 'KoreAdminBundle', 'routes' => array(
            'admin_region_index',
            'admin_region_new',
            'admin_region_show',
            'admin_region_edit',
        )));
*/
        $sidemenu->addChild('sidemenu.issuer.root', array('route' => 'admin_issuer_index'))->setExtras(array('translation_domain' => 'KoreAdminBundle', 'routes' => array(
            'admin_issuer_index',
            'admin_issuer_new',
            'admin_issuer_show',
            'admin_issuer_edit',
        )));
        $sidemenu->addChild('sidemenu.budget.root', array('route' => 'admin_budget_index'))->setExtras(array('translation_domain' => 'KoreAdminBundle', 'routes' => array(
            'admin_budget_index',
            'admin_budget_new',
            'admin_budget_show',
            'admin_budget_edit',
        )));
        $sidemenu->addChild('sidemenu.client.root', array('route' => 'admin_client_index'))->setExtras(array('translation_domain' => 'KoreAdminBundle', 'routes' => array(
            'admin_client_index',
            'admin_client_new',
            'admin_client_show',
            'admin_client_edit',
        )));
        $sidemenu->addChild('sidemenu.item.root', array('route' => 'admin_item_index'))->setExtras(array('translation_domain' => 'KoreAdminBundle', 'routes' => array(
            'admin_item_index',
            'admin_item_new',
            'admin_item_show',
            'admin_item_edit',
        )));
        $sidemenu->addChild('sidemenu.product.root', array('route' => 'admin_product_index'))->setExtras(array('translation_domain' => 'KoreAdminBundle', 'routes' => array(
            'admin_product_index',
            'admin_product_new',
            'admin_product_show',
            'admin_product_edit',
        )));
        $sidemenu->addChild('sidemenu.provider.root', array('route' => 'admin_provider_index'))->setExtras(array('translation_domain' => 'KoreAdminBundle', 'routes' => array(
            'admin_provider_index',
            'admin_provider_new',
            'admin_provider_show',
            'admin_provider_edit',
        )));
        $sidemenu->addChild('sidemenu.seller.root', array('route' => 'admin_seller_index'))->setExtras(array('translation_domain' => 'KoreAdminBundle', 'routes' => array(
            'admin_seller_index',
            'admin_seller_new',
            'admin_seller_show',
            'admin_seller_edit',
        )));
        $sidemenu->addChild('sidemenu.note.root', array('route' => 'admin_note_index'))->setExtras(array('translation_domain' => 'KoreAdminBundle', 'routes' => array(
            'admin_note_index',
            'admin_note_new',
            'admin_note_show',
            'admin_note_edit',
        )));

        return $sidemenu;
    }

}