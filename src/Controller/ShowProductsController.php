<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\Category;
use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ShowProductsController extends AbstractController
{
    /**
     * @Route("/show/products", name="show_products")
     */
    public function index(ProductRepository $productRepository, CategoryRepository $categoryRepository)
    {
        return $this->render('show_products/index.html.twig', [
            'controller_name' => 'ShowProductsController',
            'products' => $productRepository->findAll(),
            'category' => $categoryRepository->findAll(),
        ]);
    }


    /**
     * @Route("/kategorie/{id}", name="kategorie", methods="GET")
     */
    public function kategorie(ProductRepository $productRepository, CategoryRepository $categoryRepository, $id)
    {
        return $this->render('show_products/index.html.twig', [
            'products' => $productRepository->kategorie($id),
            'category' => $categoryRepository->findAll()
        ]);
    }


}
