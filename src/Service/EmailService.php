<?php

namespace App\Service;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Twig\Environment;

class EmailService 
{
    private $mailer;
    private $template;

    public function __construct(
        MailerInterface $mailer,// il sert à la gestion de l'envoie de mail
        Environment $template) // il gere le format de mail
    {
       $this->mailer = $mailer;
       $this->template = $template;
    }
    
    public function sendMail($email,$suject,$body)
    {
        $mail = (new Email())
            ->from('mailAdress@gmail.com')
            ->to($email)
            ->subject($suject)
            ->html($body)
        ;
        //dd($mail);
        $this->mailer->send($mail);
    }

   
}