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
//        $header = $em->getRepository('KoreAdminBundle:Header')->findOneById(1);
        $photographies = $em->getRepository('KoreAdminBundle:Photography')->findAll();
        $contacts = $em->getRepository('KoreAdminBundle:Contact')->findAll();
        $brands = $em->getRepository('KoreAdminBundle:Brand')->findAll();
        $features = $em->getRepository('KoreAdminBundle:Feature')->findAll();
        return $this->render('KoreFrontBundle:Front:index.html.twig', array(
            'photographies' => $photographies,
            'contacts'      => $contacts,
            'brands'        => $brands,
            'features'      => $features,
        ));
    }
    
    public function productAction()
    {
        return $this->render('KoreFrontBundle:Front:product.html.twig');
    }

}
