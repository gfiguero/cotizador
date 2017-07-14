<?php

namespace Kore\FrontBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

class Builder implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    public function topMenu(FactoryInterface $factory, array $options)
    {
        $topmenu = $factory->createItem('root');
        $topmenu->setChildrenAttribute('class', 'nav navbar-nav navbar-right');
        $topmenu->setChildrenAttribute('id', 'topmenu');

        $topmenu->addChild('topmenu.home', array('uri' => '#home'))->setExtras(array('translation_domain' => 'KoreFrontBundle'))->setLinkAttribute('class', 'page-scroll');
        $topmenu->addChild('topmenu.about', array('uri' => '#about'))->setExtras(array('translation_domain' => 'KoreFrontBundle'))->setLinkAttribute('class', 'page-scroll');
        $topmenu->addChild('topmenu.feature', array('uri' => '#feature'))->setExtras(array('translation_domain' => 'KoreFrontBundle'))->setLinkAttribute('class', 'page-scroll');
        $topmenu->addChild('topmenu.contact', array('uri' => '#contact'))->setExtras(array('translation_domain' => 'KoreFrontBundle'))->setLinkAttribute('class', 'page-scroll');
        $topmenu->addChild('topmenu.product', array('route' => 'front_product'))->setExtras(array('translation_domain' => 'KoreFrontBundle'))->setLinkAttribute('class', 'page-scroll');

        return $topmenu;
    }

}