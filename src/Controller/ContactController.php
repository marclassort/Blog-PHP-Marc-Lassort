<?php

namespace App\Controller;

use Core\BaseController;

class ContactController extends BaseController 
{

    public function contact() 
    {
        return $this->render('frontend/contact.html.twig', []);
    }

}