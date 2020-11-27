<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
  /**
   * @Route("/", name="home")
   */
  public function home(ProductRepository $productRepository): Response
  {
    return $this->render('index/home.html.twig', [
      'products' => $productRepository->top(Product::NB_TOP)
    ]);
  }
}
