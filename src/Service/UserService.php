<?php

namespace App\Service;

use App\Entity\Address;
use App\Entity\Customer;
use App\Entity\User;
use App\Repository\AddressRepository;
use App\Repository\CustomerRepository;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\Types\Void_;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserService
{
    private $em;
    private $passwordhash;
    private $client;
    private $address;
    private $params;

    public function __construct(
        EntityManagerInterface $em,
        UserPasswordHasherInterface $passwordhash,
        CustomerRepository $client,
        AddressRepository $address,
        ParameterBagInterface $params
    ) {
        $this->em = $em;
        $this->passwordhash = $passwordhash;
        $this->client = $client;
        $this->address = $address;
        $this->params = $params;
    }
    public function message()
    {
        return 'mot de passe incorrect';
        
    }
    public function modifier(Request $request, User $user): void
    {

        $req = $request->request;
        if ($this->passwordhash->isPasswordValid($user, $req->get('password'))) {
            $user
                ->setLastname($req->get('prenom'))
                ->setFirstname($req->get('nom'))
                ->setEmail($req->get('email'))
            ;
            $this->em->persist($user);
            $this->em->flush();   
        }else {
            $this->message();
        }
    }
    public function motpasse(Request $request, User $user): void
    {
        $req = $request->request;
        if ($this->passwordhash->isPasswordValid($user, $req->get('password'))) {
            if ($req->get('password')) {
                $user->setPassword(
                    $this->passwordhash->hashPassword(
                        $user,
                        $req->get('newpassword')
                    )
                );
            }
            $this->em->persist($user);
            $this->em->flush();
        }
    }
    public function address(Request $request, User $user): void
    {
        $req = $request->request;
        $address = new Address;
        $address
            ->setAddress($req->get('adresse'))
            ->setPostalCode($req->get('postal'))
            ->setCountry($req->get('pays'))
            ->setCity($req->get('ville'))
            ->setCustomer(
                $this->client->findOneBy(['users' => $user->getId()])
            )
        ;
        $this->em->persist($address);
        $this->em->flush();
    }
    public function getAddress(User $user): array
    {
        $id= $this->client->findOneBy(['users' => $user->getId()])->getId();
        return $this->address->getAddressById($id);
    }
    public function getCustomer(User $user): array
    {
        $id= $this->client->findOneBy(['users' => $user->getId()])->getId();
        return $this->client->getAddressById($id);
    }
    public function delete(Address $address): void
    {
        $this->em->remove($address);
        $this->em->flush();
    }
    public function updatePicture(Request $request, User $user): void
    {
        $picture = $request->files->get('picture');
      
        $newFileName = 'user' . $user->getId(). ''. $picture->guessExtension();
        $picture ->move(
            $this->params->get('profiles'),
            $newFileName
        );

        $user->setPicture($newFileName);
        $this->em->persist($user);
        $this->em->flush();
    }
}
