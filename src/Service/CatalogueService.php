<?php

namespace App\Service;

use App\Repository\CategoryRepository;

class CatalogueService 
{
    private $categoryRepository;
    
   public function __construct(CategoryRepository $categoryRepository)
   {
        $this->categoryRepository = $categoryRepository;
   }
   
   public function getCategories(): array
   {
        
        return $this->categoryRepository->findAll();
   } 
}