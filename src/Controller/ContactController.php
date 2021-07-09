<?php

namespace App\Controller;

use Core\BaseController;

class ContactController extends BaseController 
{

    public function contact() {

        $string = "Marc Lassort";
        return $this->render('frontend/contact.html.twig', [
            "string" => $string
        ]);
    }

}