<?php

namespace App\Controller\Admin;

use App\Form\ImportProductsType;
use App\Service\ProductService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    private $productService;

    public function __construct(
        ProductService $productService)
    {
        $this->productService = $productService;
    }

    #[Route('/admin/product', name: 'admin_product')]
    public function index(Request $request): Response
    {
        $form = $this->createForm(ImportProductsType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->productService->pushProducts($form->get('file')->getData());
        }

        return $this->render('admin/product/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
