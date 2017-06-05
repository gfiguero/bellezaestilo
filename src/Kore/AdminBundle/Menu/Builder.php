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
        $sidemenu = $factory->createItem('root');
        $sidemenu->setChildrenAttribute('class', 'nav navbar-nav');
        $sidemenu->setChildrenAttribute('id', 'top-menu');

        $sidemenu->addChild('sidemenu.frontpage', array('route' => 'admin_frontpage_index'))->setAttributes(array('icon' => 'database fa-fw', 'translation_domain' => 'KoreAdminBundle'));

        return $sidemenu;
    }

    public function sideMenu(FactoryInterface $factory, array $options)
    {
        $sidemenu = $factory->createItem('root');
        $sidemenu->setChildrenAttribute('class', 'metismenu');
        $sidemenu->setChildrenAttribute('id', 'side-menu');

        $sidemenu->addChild('sidemenu.frontpage', array('route' => 'admin_frontpage_index'))->setExtras(array('icon' => 'database fa-fw', 'translation_domain' => 'KoreAdminBundle'));
        $sidemenu->addChild('sidemenu.feature', array('route' => 'admin_feature_index'))->setExtras(array('icon' => 'database fa-fw', 'translation_domain' => 'KoreAdminBundle'));
        $sidemenu->addChild('sidemenu.product', array('route' => 'admin_product_index'))->setExtras(array('icon' => 'database fa-fw', 'translation_domain' => 'KoreAdminBundle'));

//        $sidemenu->addChild('sidemenu.datacenter')->setExtras(array('icon' => 'database fa-fw', 'translation_domain' => 'HVGAgentBundle'))->setLabelAttributes(array('class' => 'has-arrow'));
//        $sidemenu['sidemenu.datacenter']->setChildrenAttribute('class', 'lalala');
//        $sidemenu['sidemenu.datacenter']->addChild('sidemenu.community', array('route' => 'admin_product_index'))->setExtra('translation_domain', 'HVGAgentBundle');

        return $sidemenu;
    }

}