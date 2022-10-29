<?php

namespace App\Controller;

use App\Service\HomeService;
use App\Service\ProductService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    private $homeService;
    private $productService;

    public function __construct(
        HomeService $homeService,
        ProductService $productService)
    {
        $this->homeService = $homeService;
        $this->productService = $productService;
    }

    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('app/home/index.html.twig', [
            'categories' => $this->homeService->getCategories(),
            'products' => $this->productService->getProducts(),
        ]);
    }
}
