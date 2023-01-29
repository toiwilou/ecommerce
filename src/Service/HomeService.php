<?php

namespace App\Service;

use App\Entity\Category;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;

class HomeService 
{
    private $em;
    private $categoryRepository;

    public function __construct(
        EntityManagerInterface $em,
        CategoryRepository $categoryRepository)
    {
        $this->em = $em;
        $this->categoryRepository = $categoryRepository;
    }

    public function getCategories (): array
    {
        return $this->categoryRepository->findAll();
    }
    public function getArticle(Request $request){
        
        $search = $request->query->get('search');
    }
    public function getProducts (): array
    {
        /* $categories = [
            'Alimentation',
            'Electroménager',
            'Hygiène et Beauté',
            'Sport',
            'Vêtement',
            'Accessoires',
            'Meubles'
        ];

        foreach ($categories as $category) {
            $newCategory = new Category();
            $newCategory->setName($category);
            $this->em->persist($newCategory);
            $this->em->flush();
        } */


        return [];
    }
}