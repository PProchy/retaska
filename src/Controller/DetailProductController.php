<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Product;
use Symfony\Component\HttpFoundation\Response;

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

}
