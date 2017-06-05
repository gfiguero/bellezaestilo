<?php

namespace Kore\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('KoreAdminBundle:Default:index.html.twig');
    }
}
