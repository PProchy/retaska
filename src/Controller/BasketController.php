<?php

namespace App\Controller;

use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class BasketController extends AbstractController
{
    /**
     * @Route("/basket", name="basket")
     */
    public function index(SessionInterface $session)
    {
        $basket = $session->get('basket',[]);

        return $this->render('basket/index.html.twig', [

            'basket' => $basket
        ]);
    }


    /**
     * @Route("/basket-plus/{id}", name="basket_plus")
     */
    public function plus(SessionInterface $session, Product $product)
    {
        $basket = $session->get('basket',[]);

        $basket[$product->getId()]['amount']++;

        $session->set('basket',$basket);


        return $this->redirectToRoute('basket');
    }

    /**
     * @Route("/basket-minus/{id}", name="basket_minus")
     */
    public function minus(SessionInterface $session, Product $product)
    {
        $basket = $session->get('basket',[]);

        $basket[$product->getId()]['amount']--;

        $session->set('basket',$basket);


        return $this->redirectToRoute('basket');
    }

    /**
     * @Route("/basket-add/{id}", name="basket_add")
     */
    public function add(Product $product, SessionInterface $session)
    {

        $basket = $session->get('basket',[]);


        $basket[$product->getId()] = [
            'id' => $product->getId(),
            'name' => $product->getName(),
            'price' => $product->getPrice(),
            'amount' => 1
        ];

        $session->set('basket',$basket);

        return $this->redirectToRoute('basket');
    }
}
