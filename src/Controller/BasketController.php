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

            'basket' => $basket,

        ]);
    }


    /**
     * @Route("/basket-plus/{id}", name="basket_plus")
     */
    public function plus(SessionInterface $session, Product $product)
    {
        $basket = $session->get('basket',[]);

        $basket[$product->getId()]['amount']++;


        $amount = $basket[$product->getId()] ['amount'];
        $price = $product->getPrice();
        $total = $price * $amount;
        $kosik[$product->getId()]['total'] = $total;

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

        $amount = $basket[$product->getId()] ['amount'];
        $price = $product->getPrice();
        $total = $price * $amount;
        $kosik[$product->getId()]['total'] = $total;

        $session->set('basket',$basket);


        return $this->redirectToRoute('basket');
    }

    /**
     * @Route("/basket-add/{id}", name="basket_add")
     */
    public function add(Product $product, SessionInterface $session)
    {

        $amount = 1;
        $price = $product->getPrice();
        $total = $price * $amount;

        $basket = $session->get('basket',[]);


        $basket[$product->getId()] = [
            'id' => $product->getId(),
            'name' => $product->getName(),
            'price' => $product->getPrice(),
            'amount' => 1,
            'total' => $total,
        ];

        $session->set('basket',$basket);

        return $this->redirectToRoute('basket');
    }

    /**
     * @Route("/basket-empty/", name="basket_clear")
     */
    public function clearBasket(SessionInterface $session)
    {
        $basket = [];
        $session->set('basket', $basket);
        return $this->redirectToRoute('basket', [
        ]);
    }

    /**
     * @Route("/basket/remove:delete/{id}", name="basket_delete")
     */
    public function basketDelete(SessionInterface $session, Product $product)
    {
        $basket = $session->get('basket', []);
        unset($basket[$product->getId()]);
        $session->set('basket', $basket);
        return $this->redirectToRoute('basket');
    }
}
