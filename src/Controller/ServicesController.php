<?php

namespace App\Controller;

use Core\BaseController;

class ServicesController extends BaseController 
{

    public function services() {
        return $this->render('frontend/services.html.twig');
    }

}