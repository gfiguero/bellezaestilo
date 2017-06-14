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

        $topmenu->addChild('topmenu.header', array('route' => 'admin_header_index'))->setAttributes(array('icon' => 'database fa-fw', 'translation_domain' => 'KoreAdminBundle'));

        return $topmenu;
    }

    public function sideMenu(FactoryInterface $factory, array $options)
    {
        $sidemenu = $factory->createItem('root');
        $sidemenu->setChildrenAttribute('class', 'metismenu');
        $sidemenu->setChildrenAttribute('id', 'side-menu');

        $sidemenu->addChild('sidemenu.header', array('route' => 'admin_header_index'))->setExtras(array('icon' => 'database fa-fw', 'translation_domain' => 'KoreAdminBundle'));
        $sidemenu->addChild('sidemenu.feature', array('route' => 'admin_feature_index'))->setExtras(array('icon' => 'database fa-fw', 'translation_domain' => 'KoreAdminBundle'));
        $sidemenu->addChild('sidemenu.brand', array('route' => 'admin_brand_index'))->setExtras(array('icon' => 'database fa-fw', 'translation_domain' => 'KoreAdminBundle'));
        $sidemenu->addChild('sidemenu.photography', array('route' => 'admin_photography_index'))->setExtras(array('icon' => 'database fa-fw', 'translation_domain' => 'KoreAdminBundle'));
        $sidemenu->addChild('sidemenu.contact', array('route' => 'admin_contact_index'))->setExtras(array('icon' => 'database fa-fw', 'translation_domain' => 'KoreAdminBundle'));
        $sidemenu->addChild('sidemenu.productgroup', array('route' => 'admin_productgroup_index'))->setExtras(array('icon' => 'database fa-fw', 'translation_domain' => 'KoreAdminBundle'));
//        $sidemenu->addChild('sidemenu.product', array('route' => 'admin_product_index'))->setExtras(array('icon' => 'database fa-fw', 'translation_domain' => 'KoreAdminBundle'));

//        $sidemenu->addChild('sidemenu.datacenter')->setExtras(array('icon' => 'database fa-fw', 'translation_domain' => 'HVGAgentBundle'))->setLabelAttributes(array('class' => 'has-arrow'));
//        $sidemenu['sidemenu.datacenter']->setChildrenAttribute('class', 'lalala');
//        $sidemenu['sidemenu.datacenter']->addChild('sidemenu.community', array('route' => 'admin_product_index'))->setExtra('translation_domain', 'HVGAgentBundle');

        return $sidemenu;
    }

}