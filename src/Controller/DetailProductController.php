<?php

namespace App\Controller;


use App\Entity\Order;
use App\Entity\Payment;
use App\Entity\Product;
use App\Form\OrderType;
use App\Form\ProductType;
use App\Repository\PaymentRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DetailProductController extends AbstractController
{
    /**
     * @Route("/show/products/detail/{id}", name="detail_product", methods={"GET"})
     */
    public function show(Product $product): Response
    {
        return $this->render('detail_product/index.html.twig', [
            'product' => $product
        ]);
    }

    /**
     * @Route("/{id}/objednavka", name="objednavka", methods={"GET","POST"})
     */
    public function new(Request $request, Product $product, PaymentRepository $paymentRepository): Response
    {
        $objednavka = new Order();
        $form = $this->createForm(OrderType::class, $objednavka);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $objednavka->setProduct($product);
            $objednavka->setCelkovaCena($product->getPrice());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($objednavka);
            $entityManager->flush();
            return $this->redirectToRoute('thankyou.html.twig');
        }
        return $this->render('order/new.html.twig', [
            'objednavka' => $objednavka,
            'form' => $form->createView(),
            'product' => $product,
            'payment' => $paymentRepository->findAll(),
        ]);
    }

    /**
     * @Route("/thankyou", name="thankyou", methods={"GET"})
     */
    public function thankyou(ProductRepository $productRepository): Response
    {
        return $this->render('order/thankyou.html.twig', [

        ]);
    }


}
