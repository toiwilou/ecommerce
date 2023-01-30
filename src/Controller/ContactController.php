<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Service\ContactService;
use PhpParser\Builder\Property;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    private $contactService;
    
    public function __construct(ContactService $contactService)
    {
        $this->contactService = $contactService;   
    }
    
    #[Route('/contact', name: 'app_contact')]
    public function index(): Response
    {
        $this->contactService->sendMailContact();
        return $this->render('contact/index.html.twig', [
            
        ]);
    }
}