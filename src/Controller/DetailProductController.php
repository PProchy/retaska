<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DetailProductController extends AbstractController
{
    /**
     * @Route("/detail/product", name="detail_product")
     */
    public function index()
    {
        return $this->render('detail_product/index.html.twig', [
            'controller_name' => 'DetailProductController',
        ]);
    }
}
