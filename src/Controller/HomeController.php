<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use App\Service\HomeService;
use Symfony\Component\HttpFoundation\Request;
use App\Service\ProductService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    private $homeService;
    private $productRepository;
    private $productService;

    public function __construct(
        HomeService $homeService,
        ProductService $productService,
        ProductRepository $productRepository)
    {
        $this->homeService = $homeService;
        $this->productRepository = $productRepository;
        $this->productService = $productService;
    }

    #[Route('/', name: 'app_home')]
    public function index(Request $request): Response
    {
        
        $search = $request->query->get('search');
        return $this->render('app/home/index.html.twig', [
            'categories' => $this->homeService->getCategories(),
            'products' => $this->productService->getProducts(),
            'products' => $this->productRepository->recherche($search),
            
        ]);
    }
    
    
    
    
    
}
