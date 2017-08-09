<?php

namespace Kore\AgentBundle\Controller;

use Kore\AdminBundle\Entity\Budget;
use Kore\AgentBundle\Form\BudgetType;
use Kore\AgentBundle\Form\TestType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TestController extends Controller
{
    public function indexAction(Request $request)
    {
        $testForm = $this->createForm(new TestType());
        return $this->render('KoreAgentBundle:Test:index.html.twig', array(
            'testForm' => $testForm->createView(),
        ));
    }

}
