<?php

namespace Kore\AgentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Kore\AdminBundle\Entity\Ruta;
use Kore\AgentBundle\Form\RutaType;
use Kore\AgentBundle\Form\RutaBuscarType;
use Kore\AgentBundle\Form\RutaReceiptType;
use Kore\AdminBundle\Entity\RutaEstado;

/**
 * Ruta controller.
 *
 */
class RutaController extends Controller
{

    public function indexAction(Request $request, RutaEstado $estado)
    {
        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        $rutas = $em->getRepository('KoreAdminBundle:Ruta')->findByEstadoId($estado->getId(), $sort, $direction);
        $paginator = $this->get('knp_paginator');
        $rutas = $paginator->paginate($rutas, $request->query->getInt('page', 1), 100);

        return $this->render('KoreAgentBundle:Ruta:index.html.twig', array(
            'rutas' => $rutas,
            'direction' => $direction,
            'sort' => $sort,
        ));
    }

    /**
     * Creates a new Ruta entity.
     *
     */
    public function newAction(Request $request)
    {
        $ruta = new Ruta();
        $newForm = $this->createForm(new RutaType(), $ruta);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted()) {
            if($newForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($ruta);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'ruta.new.flash' );
                return $this->redirect($this->generateUrl('agent_ruta_estado_0'));
            }
        }

        $options = $newForm->get('solicitudes')->getConfig()->getOptions();

        return $this->render('KoreAgentBundle:Ruta:new.html.twig', array(
            'newForm' => $newForm->createView(),
            'choices' => $options['choice_list']->getChoices(),
        ));
    }

    /**
     * Finds and displays a Ruta entity.
     *
     */
    public function showAction(Ruta $ruta)
    {
        $deleteForm = $this->createDeleteForm($ruta);
        return $this->render('KoreAgentBundle:Ruta:show.html.twig', array(
            'ruta' => $ruta,
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    public function pdfAction(Ruta $ruta)
    {
//        $url = $this->generateUrl('agent_ruta_export', array('id' => $ruta->getId()), true);
//        return $this->redirect($url);
        $html = $this->renderView('KoreAgentBundle:Ruta:pdf.html.twig', array('ruta' => $ruta));
        return new Response(
//            $this->get('knp_snappy.pdf')->getOutput($url), 200,
            $this->get('knp_snappy.pdf')->getOutputFromHtml($html), 200,
            array(
                'Content-Type'          => 'application/pdf',
//                'Content-Disposition'   => 'attachment; filename="ruta'.$ruta->getId().'.pdf"'
            )
        );
    }

    public function exportAction(Ruta $ruta)
    {
        return $this->render('KoreAgentBundle:Ruta:pdf.html.twig', array(
            'ruta' => $ruta,
        ));
    }

    /**
     * Displays a form to edit an existing Ruta entity.
     *
     */
    public function editAction(Request $request, Ruta $ruta)
    {
        $editForm = $this->createEditForm($ruta);
        $deleteForm = $this->createDeleteForm($ruta);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()) {
            if($editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($ruta);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'ruta.edit.flash' );
                return $this->redirect($this->generateUrl('agent_ruta_estado_0'));
            }
        }

        $options = $editForm->get('solicitudes')->getConfig()->getOptions();

        return $this->render('KoreAgentBundle:Ruta:edit.html.twig', array(
            'ruta'       => $ruta,
            'editForm'   => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
            'choices'    => $options['choice_list']->getChoices(),
        ));
    }

    /**
     * Creates a form to edit a Ruta entity.
     *
     * @param Ruta $ruta The Ruta entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Ruta $ruta)
    {
        return $this->createForm(new RutaType(), $ruta, array(
            'id'   => $ruta->getId(),
            'action' => $this->generateUrl('agent_ruta_edit', array('id' => $ruta->getId())),
        ));
    }

    /**
     * Deletes a Ruta entity.
     *
     */
    public function deleteAction(Request $request, Ruta $ruta)
    {
        $deleteForm = $this->createDeleteForm($ruta);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($ruta);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'ruta.delete.flash' );
        }

        return $this->redirect($this->generateUrl('agent_ruta_estado_0'));
    }

    /**
     * Creates a form to delete a Ruta entity.
     *
     * @param Ruta $ruta The Ruta entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Ruta $ruta)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('agent_ruta_delete', array('id' => $ruta->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    public function buscarAction(Request $request)
    {
        $buscarForm = $this->createForm(new RutaBuscarType());
        $buscarForm->handleRequest($request);

        if ($buscarForm->isSubmitted()) {
            if($buscarForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $id = $buscarForm->get('id')->getData();
                $ruta = $em->getRepository('KoreAdminBundle:Ruta')->findOneById($id);
                if($ruta) {
                    return $this->redirect($this->generateUrl('agent_ruta_show', array('id' => $ruta->getId())));
                }
                $request->getSession()->getFlashBag()->add( 'warning', 'ruta.buscar.flash' );
            }
        }

        return $this->render('KoreAgentBundle:Ruta:buscar.html.twig', array(
            'buscarForm' => $buscarForm->createView(),
        ));
    }

    public function receiptAction(Request $request, Ruta $ruta)
    {
        $receiptForm = $this->createForm(new RutaReceiptType(), $ruta);
        $receiptForm->handleRequest($request);

        if ($receiptForm->isSubmitted()) {
            if($receiptForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($ruta);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'ruta.receipt.flash' );
                return $this->redirect($this->generateUrl('agent_ruta_estado_5'));
            }
        }

        return $this->render('KoreAgentBundle:Ruta:receipt.html.twig', array(
            'ruta'        => $ruta,
            'receiptForm' => $receiptForm->createView(),
        ));
    }
}
