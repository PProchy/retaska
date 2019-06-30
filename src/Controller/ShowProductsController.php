<?php

namespace App\Controller;

use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Category;
use Symfony\Component\HttpFoundation\Request;
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


    /**
     * @Route("/search", name="search")
     */
    public function search(EntityManagerInterface $entityManager, Request $request,CategoryRepository $categoryRepository)
    {

        $search = $request->query->get('search');
        $products = $entityManager
            ->createQuery("SELECT p FROM " . Product::class . " p WHERE p.name LIKE :search")
            ->setParameter('search', "%$search%")
            ->getResult();

        return $this->render('show_products/index.html.twig', [
            'products' => $products,
            'searchedFor' => $search,
            'category' => $categoryRepository->findAll()

        ]);
    }





}
