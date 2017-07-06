<?php

namespace Kore\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Kore\AdminBundle\Entity\Photography;
use Kore\AdminBundle\Entity\Header;
use Kore\AdminBundle\Entity\Contact;
use Kore\AdminBundle\Entity\Brand;
use Kore\AdminBundle\Entity\Feature;

class FrontController extends Controller
{
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $photographies = $em->getRepository('KoreAdminBundle:Photography')->findAll();
        $brands = $em->getRepository('KoreAdminBundle:Brand')->findAll();
        return $this->render('KoreFrontBundle:Front:index.html.twig', array(
            'photographies' => $photographies,
            'brands'        => $brands,
        ));
    }
    
    public function productAction()
    {
        $em = $this->getDoctrine()->getManager();
        $productGroups = $em->getRepository('KoreAdminBundle:ProductGroup')->findAll();
        return $this->render('KoreFrontBundle:Front:product.html.twig', array(
            'productGroups' => $productGroups,
        ));
    }

}
