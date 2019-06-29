<?php

namespace App\Controller;

use App\Entity\Orders;
use App\Entity\Product;
use App\Form\OrdersType;
use App\Repository\OrdersRepository;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class OrdersController extends AbstractController
{
    /**
     * @Route("/admin/orders", name="orders_index", methods={"GET"})
     */
    public function index(OrdersRepository $ordersRepository): Response
    {
        return $this->render('orders/index.html.twig', [
            'orders' => $ordersRepository->findAll(),
        ]);
    }

    /**
     * @Route("orders/new", name="orders_new", methods={"GET","POST"})
     */
    public function new(Request $request, SessionInterface $session, ProductRepository $productRepository): Response
    {
        $order = new Orders();
        $productsOrder = $session->get('basket');

        $form = $this->createForm(OrdersType::class, $order);
        $form->handleRequest($request);

        $order->setProducts($productsOrder);



        $totalprice = array_sum(array_column($productsOrder, 'total'));

        $order->setTotalPrice($totalprice);

        if ($form->isSubmitted() && $form->isValid()) {

            $order->setStatus(0);


            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($order);
            $entityManager->flush();

            // vyprázdnění košíku po odeslání objednávky:
            $basket = [];
            $session->set('basket', $basket);

            return $this->redirectToRoute('thankyou');
        }




        return $this->render('orders/new.html.twig', [
            'order' => $order,
            'form' => $form->createView(),
            'totalprice'=> $totalprice,

        ]);
    }

    /**
     * @Route("admin/orders/{id}", name="orders_show", methods={"GET"})
     */
    public function show(Orders $order): Response
    {
        return $this->render('orders/show.html.twig', [
            'order' => $order,
        ]);
    }

    /**
     * @Route("admin/orders/{id}/edit", name="orders_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Orders $order): Response
    {
        $form = $this->createForm(OrdersType::class, $order);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('orders_index', [
                'id' => $order->getId(),
            ]);
        }

        return $this->render('orders/edit.html.twig', [
            'order' => $order,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("admi/orders/{id}", name="orders_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Orders $order): Response
    {
        if ($this->isCsrfTokenValid('delete'.$order->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($order);
            $entityManager->flush();
        }

        return $this->redirectToRoute('orders_index');
    }
}
