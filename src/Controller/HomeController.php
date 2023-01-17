<?php

namespace App\Controller;

use App\Helper\CartHelper;
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
    private $cartHelper;

    public function __construct(
        HomeService $homeService,
        ProductService $productService,
        ProductRepository $productRepository,
        CartHelper $cartHelper
    ) {
        $this->homeService = $homeService;
        $this->productRepository = $productRepository;
        $this->productService = $productService;
        $this->cartHelper = $cartHelper;
    }

    #[Route('/', name: 'app_home')]
    public function index(Request $request): Response
    {

        $search = $request->query->get('search');
        if ($search) {
            $recherche = array_merge(
                $this->productRepository->recherche($search, 'name'),
                $this->productRepository->recherche($search, 'description')
            );
            return $this->render('app/home/index.html.twig', [
                'categories' => $this->homeService->getCategories(),
                'products' => $recherche

            ]);
        }
        return $this->render('app/home/index.html.twig', [
            'categories' => $this->homeService->getCategories(),
            'products' => $this->productService->getProducts(),
        ]);
    }
}
