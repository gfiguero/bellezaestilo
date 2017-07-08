<?php

namespace Kore\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Kore\FrontBundle\Form\LoginType;

class SecurityController extends Controller
{
    public function loginAction(Request $request)
    {
        $loginForm = $this->createForm(new LoginType());
        $loginForm->handleRequest($request);
        return $this->render('KoreFrontBundle:Security:login.html.twig', array(
            'loginForm' => $loginForm->createView(),
        ));
    }
}
