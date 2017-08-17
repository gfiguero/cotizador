<?php

namespace Kore\AgentBundle\Controller;

use Kore\AdminBundle\Entity\Product;
use Kore\AgentBundle\Form\ProductType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Product controller.
 *
 */
class ProductController extends Controller
{

    /**
     * Lists all Product entities.
     *
     */
    public function indexAction(Request $request)
    {
        $user = $this->getUser();
        $account = $user->getAccount();

        $sort = $request->query->get('sort');
        $direction = $request->query->get('direction');
        $em = $this->getDoctrine()->getManager();
        if($sort) $products = $em->getRepository('KoreAdminBundle:Product')->findBy(array('account' => $account), array($sort => $direction));
        else $products = $em->getRepository('KoreAdminBundle:Product')->findBy(array('account' => $account));
        $paginator = $this->get('knp_paginator');
        $products = $paginator->paginate($products, $request->query->getInt('page', 1), 100);

        $deleteForms = array();
        foreach($products as $key => $product) {
            $deleteForms[] = $this->createDeleteForm($product)->createView();
        }

        return $this->render('KoreAgentBundle:Product:index.html.twig', array(
            'products' => $products,
            'direction' => $direction,
            'sort' => $sort,
            'deleteForms' => $deleteForms,
        ));
    }

    /**
     * Creates a new Product entity.
     *
     */
    public function newAction(Request $request)
    {
        $user = $this->getUser();
        $account = $user->getAccount();

        $product = new Product();
        $newForm = $this->createNewForm($product);
        $newForm->handleRequest($request);

        if ($newForm->isSubmitted()) {
            if($newForm->isValid()) {
                $product->setUser($user);
                $product->setAccount($account);
                $em = $this->getDoctrine()->getManager();
                $em->persist($product);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'product.new.flash' );
                return $this->redirect($this->generateUrl('agent_product_index'));
            }
        }

        return $this->render('KoreAgentBundle:Product:new.html.twig', array(
            'newForm' => $newForm->createView(),
        ));
    }

    /**
     * Creates a form to create a new Product entity.
     *
     * @param Product $product The Product entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createNewForm(Product $product)
    {
        return $this->createForm(new ProductType(), $product, array(
            'action' => $this->generateUrl('agent_product_new'),
        ));
    }

    /**
     * Finds and displays a Product entity.
     *
     */
    public function showAction(Product $product)
    {
        $user = $this->getUser();
        $account = $user->getAccount();
        if ($account != $product->getAccount()) return $this->redirect($this->generateUrl('agent_product_index'));

        $editForm = $this->createEditForm($product);
        $deleteForm = $this->createDeleteForm($product);

        return $this->render('KoreAgentBundle:Product:show.html.twig', array(
            'product' => $product,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Product entity.
     *
     */
    public function editAction(Request $request, Product $product)
    {
        $user = $this->getUser();
        $account = $user->getAccount();
        if ($account != $product->getAccount()) return $this->redirect($this->generateUrl('agent_product_index'));

        $editForm = $this->createEditForm($product);
        $deleteForm = $this->createDeleteForm($product);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()) {
            if($editForm->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($product);
                $em->flush();
                $request->getSession()->getFlashBag()->add( 'success', 'product.edit.flash' );
                return $this->redirect($this->generateUrl('agent_product_index'));
            }
        }

        return $this->render('KoreAgentBundle:Product:edit.html.twig', array(
            'product' => $product,
            'editForm' => $editForm->createView(),
            'deleteForm' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a Product entity.
     *
     * @param Product $product The Product entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Product $product)
    {
        return $this->createForm(new ProductType(), $product, array(
            'action' => $this->generateUrl('agent_product_edit', array('id' => $product->getId())),
        ));
    }

    /**
     * Deletes a Product entity.
     *
     */
    public function deleteAction(Request $request, Product $product)
    {
        $user = $this->getUser();
        $account = $user->getAccount();
        if ($account != $product->getAccount()) return $this->redirect($this->generateUrl('agent_product_index'));

        $deleteForm = $this->createDeleteForm($product);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($product);
            $em->flush();
            $request->getSession()->getFlashBag()->add( 'danger', 'product.delete.flash' );
        }

        return $this->redirect($this->generateUrl('agent_product_index'));
    }

    /**
     * Creates a form to delete a Product entity.
     *
     * @param Product $product The Product entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Product $product)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('agent_product_delete', array('id' => $product->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    public function searchcmAction(Request $request)
    {
        $cm = $request->query->get('cm');
        $em = $this->getDoctrine()->getManager();
        $cms = $em->getRepository('KoreAdminBundle:Product')->findByCm($cm);
        $response = new JsonResponse();
        $response->setData($cms);
        return $response;
    }
}
