<?php

namespace App\Controller;

use App\Entity\Address;
use App\Entity\Customer;
use App\Entity\User;
use App\Form\ProfilType;
use App\Service\UserService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class ProfilController extends AbstractController
{
    private $userService;
    private $passwordhasher;
    public function __construct(
        UserService $userService,
        UserPasswordHasherInterface $passwordhasher
    ) {
        $this->userService = $userService;
        $this->passwordhasher = $passwordhasher;
    }
    #[Route('/profil', name: 'app_profil')]
    public function index()
    {
        return $this->render('app/home/profil.html.twig', [
            'controller_name' => 'ProfilController',
        ]);
    }
    #[Route('/motpasse/{word}', name: 'app_motpasse')]
    public function password($word):JsonResponse
    {
       $response = $this->passwordhasher->isPasswordValid($this->getUser(),$word);
       return new JsonResponse($response);
    }
    #[Route('/gestion', name: 'app_gestionprofil')]
    public function gesion(Request $request): Response
    {
        $message = null;
        if ($request->isMethod('post') && $request->request->get('ModifierProfil') == "modifierProfil") {
            $this->userService->modifier($request, $this->getUser());
            $message = 'vos modifications sont bien effectué';
        }
        if ($request->isMethod('post') && $request->request->get('ModifierMotPasse') == "motpasseProfil") {
            if ($request->request->get('newpassword') == $request->request->get('confirm_password')) {
                $this->userService->motpasse($request, $this->getUser());
                return $this->redirectToRoute('app_logout');
            } else {
                return $this->render('app/home/gestionprofil.html.twig', []);
            }
        }

        return $this->render('app/home/gestionprofil.html.twig', [
            'address' => $this->userService->getAddress($this->getUser()),
            'customer' => $this->userService->getCustomer($this->getUser()),
            'message' => $message,
            'motPasse' => $this->passwordhasher->hashPassword($this->getUser(), "merci")
        ]);
    }

    #[Route('/adresse', name: 'app_addprofil')]
    public function address(Request $request): Response
    {
        if ($request->isMethod('post')) {
            $this->userService->address($request, $this->getUser());
            return $this->redirectToRoute('app_gestionprofil');
        }
    }
    #[Route('/historique', name: 'app_historiqueprofil')]
    public function historique()
    {
        return $this->render('app/home/historique.html.twig', []);
    }
    #[Route('/favoris', name: 'app_favorisprofil')]
    public function favoris()
    {
        return $this->render('app/home/favoris.html.twig', []);
    }
    #[Route('address_delete/{id}', name: 'address_delete')]
    public function delete(Address $address)
    {
        $this->userService->delete($address);
        return $this->redirectToRoute('app_gestionprofil');
    }
    #[Route('update_picture',name:'update_picture')]
    public function update_picture(Request $request)
    {
        $this->userService->updatePicture($request, $this->getUser());
        return $this->redirectToRoute('app_gestionprofil');
    }
}
