<?php

namespace App\Service;

use App\Entity\Category;
use App\Entity\Product;
use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;

class ProductService 
{
    private $em;
    private $productRepository;
    private $categoryRepository;

    public function __construct(
        EntityManagerInterface $em,
        ProductRepository $productRepository,
        CategoryRepository $categoryRepository)
    {
        $this->em = $em;
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
    }

    public function getProducts (): array
    {
        return $this->productRepository->findAll();
    }

    public function pushProducts ($jsonFile): void
    {
        $products = json_decode(file_get_contents($jsonFile), true);

        foreach ($products as $product)
        {
            $category = new Category();
            $category->setName($product['category']);

            $newProduct = new Product();
            $newProduct
                ->setName($product['name'])
                ->setDescription($product['description'])
                ->setPrice($product['price'])
                ->setPicture($product['picture'])
                ->setQuantity($product['quantity'])
                ->setCategory($category)
            ;

            $this->em->persist($newProduct);
            $this->em->persist($category);
        }

        $this->em->flush();
    }
}