<?php

namespace App\Controller;

use Core\BaseController;

class PrivacyController extends BaseController 
{

    public function privacy() {
        return $this->render('frontend/politique-de-confidentialite.html.twig');
    }

}