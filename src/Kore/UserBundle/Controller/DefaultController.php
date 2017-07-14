<?php

namespace Kore\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('KoreUserBundle:Default:index.html.twig');
    }
}
