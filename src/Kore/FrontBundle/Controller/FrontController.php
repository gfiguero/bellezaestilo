<?php

namespace Kore\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class FrontController extends Controller
{
    public function indexAction()
    {
        return $this->render('KoreFrontBundle:Front:index.html.twig');
    }
    
    public function aboutAction()
    {
        return $this->render('KoreFrontBundle:Front:about-us.html.twig');
    }

    public function serviceAction()
    {
        return $this->render('KoreFrontBundle:Front:service.html.twig');
    }

    public function productAction()
    {
        return $this->render('KoreFrontBundle:Front:product.html.twig');
    }

    public function contactAction()
    {
        return $this->render('KoreFrontBundle:Front:contact.html.twig');
    }
}
