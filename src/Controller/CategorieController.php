<?php

namespace App\Controller;

use App\Service\CatalogueService;
use App\Service\HomeService;
use App\Service\ProductService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategorieController extends AbstractController
{
    private $productService;
    private $catalogueService;
    
    function __construct(
                        ProductService $productService,
                        CatalogueService $catalogueService
                        )
    {
       $this->productService = $productService; 
       $this->catalogueService = $catalogueService; 
    }
    
    #[Route('/catalogue', name: 'app_categories')]
    public function index(): Response
    {
        return $this->render('categorie/index.html.twig', [
            'products' => $this->productService->getProducts(),
            'categories' => $this->catalogueService->getCategories()
        ]);
    }
    
    #[Route('/catalogue/{name}', name: 'app_categorie')]
    public function product_category($name, Request $request): Response
    {
        $id = $request->query->get('id');
        return $this->render('categorie/produit_categorie.html.twig', [
            'product' => $this->productService->getProductById($id),
            'id' => $id
        ]);
    }
    
}