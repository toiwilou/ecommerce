<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('email', EmailType::class, [
            'label' => 'E-mail',
            'attr' => [
                'class' => 'form-control',
                'placeholder' => 'E-mail' 
            ]
        ])
        ->add('firstname', TextType::class, [
            'label' => 'nom',
            'attr' => [
                'class' => 'form-control',
                'placeholder' => 'nom' 
            ]
        ] )
        ->add('lastname', TextType::class, [
            'label' => 'prenom',
            'attr' => [
                'class' => 'form-control',
                'placeholder' => 'prenom' 
            ]
        ] )
        ->add('phone', TextType::class, [
            'label' => 'telephone',
            'attr' => [
                'class' => 'form-control',
                'placeholder' => 'telephone' 
            ]
        ] )
        ->add('message', TextareaType::class, [
            'label' => 'message',
            'attr' => [
                'class' => 'form-control',
                'placeholder' => 'message' 
            ]
        ] )
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}