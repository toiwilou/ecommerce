<?php

namespace App\Service;

class ContactService 
{
    private $emailService;
    
   public function __construct(EmailService $emailService)
   {
        $this->emailService = $emailService;
   }
   
   public function sendMailContact()
   {
          $this->emailService->sendMail("fat@gmail.com",'jnjdcnjd','csjdnjcjd');
   }
}