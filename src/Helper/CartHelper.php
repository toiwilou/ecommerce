<?php

namespace App\Helper;

use Symfony\Component\HttpFoundation\RequestStack;

class CartHelper
{
    private $session;
    private $requestStack;
    
    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
        $this->session = $this->requestStack->getSession();
    }
    public function test()
    {
        $this->session->set('name','papa');
        dd($this->session->get('name'));
    }

}