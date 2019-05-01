<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ShowProductsController extends AbstractController
{
    /**
     * @Route("/show/products", name="show_products")
     */
    public function index(ProductRepository $productRepository)
    {
        return $this->render('show_products/index.html.twig', [
            'controller_name' => 'ShowProductsController',
            'products' => $productRepository->findAll(),
        ]);
    }
}
